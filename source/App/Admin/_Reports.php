<?php

use Source\App\Admin\Admin;


class Reports extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Relatórios",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/reports/relImoveis", [
            "app" => "reports/home",
            "head" => $head,
        ]);
    }
}
