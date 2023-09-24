<?php

namespace Source\App\Admin;

use mysqli;
use Source\App\Admin\Admin;



class Backup extends Admin
{
    public function __construct()
    {
        parent::__construct();
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
            redirect("/admin");
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
        $backupFile = "$backupFolder/backup-$database-$currentDate-$dateTime.sql";
        file_put_contents($backupFile, $backupContent);

        // Verifica se o arquivo de backup foi criado com sucesso
        if (file_exists($backupFile)) {

            $this->message->success("Backup gerado com sucesso!")->flash();
            redirect("/admin");
            // echo json_encode(["reload" => true]);
            // return;
            // $this->message->info("")->flash();

            // echo 'Backup gerado com sucesso! <a href="index.php">Voltar para a página inicial</a>';
        } else {
            $this->message->warning("Ocorreu um erro ao gerar o backup.")->flash();
            redirect("/admin");
            // echo 'Ocorreu um erro ao gerar o backup. <a href="index.php">Tente novamente</a>';
        }

        // Fecha a conexão com o banco de dados
        $mysqli->close();
    }
}
