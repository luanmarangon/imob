<?php

namespace Source\App\Admin;

use mysqli;
use Source\App\Admin\Admin;
use Source\Support\Email;

class Backup extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }


    public function home()
    {
        // $backup = (new Backup())->backup();

        $backupFolder = CONF_UPLOAD_DIR . "/BACKUP";
        $existingBackups = glob("$backupFolder/*");

        if ($existingBackups) {
            // Definir a função de comparação
            usort($existingBackups, function ($a, $b) {
                return filectime($a) <=> filectime($b);
            });
            $existingBackups = array_reverse($existingBackups);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Relatórios",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/backup/home", [
            "app" => "backup/home",
            "head" => $head,
            "existingBackups" => $existingBackups,
            // "backupFolder" => $backupFolder
        ]);
    }

    public function verifyBackup()
    {

        $backupFolder = CONF_UPLOAD_DIR . "/BACKUP";
        $existingBackups = glob("$backupFolder/*");

        if ($existingBackups) {
            $ultimoBackup = end($existingBackups);
            $ultimoBackupData = date("d/m/Y H:i", filectime($ultimoBackup));
            $currentTime = date("d/m/Y H:i");

            // Verificar se o último backup foi realizado há mais de uma semana
            if ($ultimoBackupData < date("d/m/Y H:i", strtotime('-7 days'))) {
                $this->message->info("Último Backup realizado há mais de uma semana em {$ultimoBackupData}. Contate o Administrador do Sistema.")->flash();
                echo json_encode(["redirect" => url("/admin/backup/home")]);
                // return;



                // Verificar se está no horário para realizar o backup
                // if ($currentTime >= "15:34" && $currentTime < "15:55") {
                // if (($currentTime > date("d/m/Y 16:00")) && ($currentTime < date("d/m/Y 16:05"))) {

                //     // Verificar se o backup já foi marcado para ser realizado nesta execução
                //     if (!isset($_SESSION['backup_in_progress'])) {
                //         $this->message->info("Realizando backup.")->flash();

                //         // Executar código de backup aqui

                //         // Marcar que o backup já está em progresso
                //         $_SESSION['backup_in_progress'] = true;

                //         // Redirecionar após realizar o backup
                //         redirect(url('admin/backup/new'));
                //     }
                // }
            }
        }
    }

    // public function list()
    // {
    //     $backupFolder = CONF_UPLOAD_DIR . "/BACKUP";
    //     $existingBackups = glob("$backupFolder/*");

    //     $backupFolder = CONF_UPLOAD_DIR . "/BACKUP";
    //     $existingBackups = glob("$backupFolder/*");

    //     if ($existingBackups) {
    //         // Definir a função de comparação
    //         usort($existingBackups, function ($a, $b) {
    //             return filectime($a) <=> filectime($b);
    //         });
    //         $existingBackups = array_reverse($existingBackups);
    //         // Iterar sobre os itens ordenados
    //         // foreach ($existingBackups as $backup) {
    //         //     // Aqui você pode realizar a lógica desejada para cada item
    //         //     echo "Arquivo: $backup, Data de Criação: " . date('d/m/Y H:i:s', filectime($backup)) . "<br>";
    //         // }
    //     }






    //     $head = $this->seo->render(
    //         CONF_SITE_NAME . " | Relatórios",
    //         CONF_SITE_DESC,
    //         url("/admin"),
    //         theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
    //         false
    //     );

    //     echo $this->view->render("widgets/backup/list", [
    //         "app" => "backup/list",
    //         "head" => $head,
    //         "existingBackups" => $existingBackups,
    //         // "backupFolder" => $backupFolder
    //     ]);
    // }





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
        } else {
            $this->message->warning("Ocorreu um erro ao gerar o backup.")->flash();
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
