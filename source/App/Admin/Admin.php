<?php

namespace Source\App\Admin;

use Source\Models\Auth;
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


        // (new Access())->report();
        // (new Online())->report();


        $this->user = Auth::user();

        if (!$this->user || $this->user->level < 5) {
            $this->message->error("Para acessar é preciso logar-se")->flash();
            redirect("/admin/login");
        }
    }
}
