<?php

namespace Source\Support;

use DateInterval;
use DateTime;
use mysqli;
use Source\Support\Email;
use Source\Support\Message;


class Backup
{

    /** @var Message */
    private $message;

    /**
     * Email constructor.
     */
    public function __construct()
    {
        $this->message = new Message();
    }

    public function verifyBackup(): bool
    {
        $backupFolder = CONF_UPLOAD_DIR . "/BACKUP";
        $existingBackups = glob("$backupFolder/*");

        $ultimoBackup = end($existingBackups);
        $ultimoBackupData = new DateTime(date("Y-m-d", filectime($ultimoBackup)));
        $currentTime = new DateTime();

        $intervalo = $currentTime->diff($ultimoBackupData);
        $days = $intervalo->days;

        if ($days > 3) {
            if ($days >= 3 && $days <= 6) {
                $this->message->warning("Último Backup realizado há mais de {$days} dias em {$ultimoBackupData->format('d/m/Y')}. É importante realizar o backup do sistema pelo Menu Backup.")->flash();
            }
            if ($days >= 7) {
                $this->message->error("Último Backup realizado há mais de {$days} dias em {$ultimoBackupData->format('d/m/Y')}. Contate o Administrador do Sistema URGENTE.")->flash();
            }
            return false;
        }
        return true;
    }
    public function backup()
    {
        // Configurações do banco de dados
        $hostname = CONF_DB_HOST;
        $database = CONF_DB_NAME;
        $username = CONF_DB_USER;
        $password = CONF_DB_PASS;

        // Pasta para armazenar os backups
        $backupFolder = CONF_UPLOAD_DIR . "/BACKUP";

        // Obtém a data atual
        $currentDate = date('Y-m-d');

        // Verifica se já existe um backup criado hoje
        $existingBackups = glob("$backupFolder/backup-$database-$currentDate-*.sql");

        if (!empty($existingBackups)) {
            $this->message->info("Já foi criado um backup hoje. Não é necessário criar outro.")->flash();
            redirect("/admin/backup/home");
            // echo 'Já foi criado um backup hoje. Não é necessário criar outro.';
            // return;
        }

        // Conexão com o banco de dados
        $mysqli = new mysqli($hostname, $username, $password, $database);

        // Verifica se ocorreu um erro na conexão
        if ($mysqli->connect_error) {
            $this->message->error("Erro na conexão com o banco de dados: " . $mysqli->connect_error)->flash();
            redirect("/admin");
            // die('Erro na conexão com o banco de dados: ' . $mysqli->connect_error);
        }

        // Define o charset para evitar problemas com caracteres especiais
        $mysqli->set_charset('utf8mb4');

        // Obtém a lista de tabelas do banco de dados
        $tables = array();
        $result = $mysqli->query("SHOW TABLES");
        while ($row = $result->fetch_row()) {
            $tables[] = $row[0];
        }

        // Cria o conteúdo do backup
        $backupContent = '';
        foreach ($tables as $table) {
            $result = $mysqli->query("SELECT * FROM $table");
            $numFields = $result->field_count;

            $backupContent .= "DROP TABLE IF EXISTS $table;\n";
            $row2 = $mysqli->query("SHOW CREATE TABLE $table")->fetch_row();
            $backupContent .= $row2[1] . ";\n\n";

            for ($i = 0; $i < $numFields; $i++) {
                while ($row = $result->fetch_row()) {
                    $backupContent .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $numFields; $j++) {
                        $row[$j] = $mysqli->real_escape_string($row[$j]);
                        if (isset($row[$j])) {
                            $backupContent .= '"' . $row[$j] . '"';
                        } else {
                            $backupContent .= 'NULL';
                        }
                        if ($j < ($numFields - 1)) {
                            $backupContent .= ',';
                        }
                    }
                    $backupContent .= ");\n";
                }
            }
            $backupContent .= "\n\n";
        }

        // Salva o conteúdo do backup em um arquivo
        $dateTime = date('Y-m-d_H-i-s');
        $backupName = "backup-$database-$currentDate-$dateTime.sql";
        $backupFile = "$backupFolder/$backupName";
        file_put_contents($backupFile, $backupContent);

        // Verifica se o arquivo de backup foi criado com sucesso
        if (file_exists($backupFile)) {

            $email = (new Backup())->backupMail()->attach($backupFolder . '/' . $backupName, $backupName);

            if ($email->attach($backupFolder . '/' . $backupName, $backupName)) {
                $email->send();
                $msgMail = "Ótimo! O backup foi gerado com sucesso e enviado para o seu e-mail!";
                $msgMailType = 'success';
            }
            $msg = ($msgMail) ?
                $msgMail :
                "O backup foi gerado com sucesso. Infelizmente, encontramos dificuldades ao enviar por e-mail. 
                Por favor, realize a cópia de segurança diretamente pela plataforma!";

            $msgType = ($msgMailType) ?   $msgMailType : 'warning';


            $this->message->$msgType($msg)->flash();
            redirect("/admin/backup/home");
            // echo json_encode(["reload" => true]);
        } else {
            $this->message->warning("Ocorreu um erro ao gerar o backup.")->flash();
            // echo json_encode(["reload" => true]);
            redirect("/admin/backup/home");
        }

        // Fecha a conexão com o banco de dados
        $mysqli->close();
    }



    public function backupMail()
    {
        $subject = "[BACKUP " . CONF_SITE_NAME . "]";
        $body = "
                    <html>
                    <head>
                        <style>
                            /* Estilos de formatação do e-mail */
                            body {
                                font-family: Arial, sans-serif;
                            }
                            .container {
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                border: 1px solid #ccc;
                                border-radius: 5px;
                                background-color: #f9f9f9;
                            }
                            h2 {
                                color: #333;
                            }
                            p {
                                margin-bottom: 15px;
                            }
                            span {
                                font-weight: bold;
                                font-style: italic;
                            }            
                            a:link, a:visited {
                                text-decoration: none
                                }
                            a:hover {
                                text-decoration: underline;
                                }
                            a:active {
                                text-decoration: none
                                }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <h2>BACKUP REALIZADO COM SUCESSO</h2>
                            <p>Prezado(a) Cliente,</p>
                            <p>Informamos que o backup da base de dados do site <a href='" . CONF_SITE_DOMAIN_LINK . "'>" . CONF_SITE_DOMAIN . "</a> foi concluído com sucesso.</p>
                            <p>Atualmente, o anexo está disponível nesta mensagem de e-mail.</p>

                            <br>
                            <p>Atenciosamente Equipe</p>
                            <h4>" . CONF_DEVELOPER_SITE . "</h4>
                        </div>
                    </body>
                    </html>
                ";

        return $email = (new Email())->bootstrap($subject, $body, CONF_MAIL_SUPPORT, CONF_SITE_NAME);
    }
}