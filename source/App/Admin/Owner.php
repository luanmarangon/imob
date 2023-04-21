<?php

namespace Source\App\Admin;

use Source\Models\Owners;
use Source\Support\Pager;
use Source\App\Admin\Admin;
use Source\Models\Contacts;
use Source\Models\OwnersContacts;

class Owner extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home(?array $data): void
    {
        $owners = (new Owners())->find()->count();


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Proprietários",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/owners/home", [
            "app" => "owners/home",
            "head" => $head,
            "owners" => $owners
        ]);
    }

    public function owners(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            // redirect("/admin/owners/owners/{$s}/1");
            echo json_encode(["redirect" => url("/admin/owners/owners/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $owners = (new Owners())->find();
        $ownersContacts = (new OwnersContacts())->find()->fetch(true);

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $owners = (new Owners())->find("MATCH(first_name, last_name, cpf, rg) AGAINST(:s)", "s={$search}");
            if (!$owners->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/owners/owners");
            }
        }
        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/owners/owners/{$all}/"));
        $pager->pager($owners->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Proprietários",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/owners/owners", [
            "app" => "owners/owners",
            "head" => $head,
            "search" => $search,
            "owners" => $owners->limit($pager->limit())->offset($pager->offset())->order("first_name, last_name")->fetch(true),
            "ownersContacts" => $ownersContacts,
            "paginator" => $pager->render()
        ]);
    }

    public function contacts(array $data)
    {

        $owners = (new Owners())->findById($data['owners_id']);

        $ownersContacts = (new OwnersContacts())->find(
            "owners_id = :owners",
            "owners={$owners->id}"
        )->fetch(true);

        $count = (new OwnersContacts())->find(
            "owners_id = :owners",
            "owners={$owners->id}"
        )->count();

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Proprietários",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/owners/contacts", [
            "app" => "owners/owners",
            "head" => $head,
            "owners" => $owners,
            "ownersContacts" => $ownersContacts,
            "count" => $count
        ]);
    }
}
