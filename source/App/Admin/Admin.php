<?php

namespace Source\App\Admin;

use Source\Models\Auth;
use Source\Support\Backup;
use Source\Core\Controller;
use Source\Models\Report\Access;
use Source\Models\Report\Online;

class Admin extends Controller
{

    /** @var \Source\Models\User null */
    protected $user;

    /**
     * Admin Constructor
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../themes/" . CONF_VIEW_ADMIN . "/");

        $backupVerify = (new Backup())->verifyBackup();

        if (!$backupVerify) {
            (new Backup())->backup();
        }

        // (new Access())->report();
        // (new Online())->report();

        $this->user = Auth::user();
        if (!$this->user || $this->user->level < 5) {
            $this->message->error("Para acessar é preciso logar-se")->flash();
            redirect("/admin/login");
        }
    }

    public function backupHome()
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


    public function execBackup()
    {

        $backup = (new Backup())->backup();



        // $this->message->success("Cliente Ativado com sucesso...")->flash();

        // echo json_encode(["redirect" => url("/admin/backup/home")]);
        // return;
    }
}