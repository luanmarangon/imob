<?php

namespace Source\App\Admin;

use Source\Models\People;
use Source\Support\Pager;
use Source\App\Admin\Admin;
use Source\Models\PeopleContacts;



class Person extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home(?array $data): void
    {
        $people = (new People())->find()->count();


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Proprietários",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/people/home", [
            "app" => "people/home",
            "head" => $head,
            "people" => $people
        ]);
    }

    public function people(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            // redirect("/admin/people/people/{$s}/1");
            echo json_encode(["redirect" => url("/admin/people/people/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $people = (new People())->find();
        $peopleContacts = (new PeopleContacts())->find()->fetch(true);

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $people = (new People())->find("MATCH(first_name, last_name, cpf, rg) AGAINST(:s)", "s={$search}");
            if (!$people->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/people/people");
            }
        }
        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/people/people/{$all}/"));
        $pager->pager($people->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Proprietários",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/people/people", [
            "app" => "people/people",
            "head" => $head,
            "search" => $search,
            "people" => $people->limit($pager->limit())->offset($pager->offset())->order("first_name, last_name")->fetch(true),
            "peopleContacts" => $peopleContacts,
            "paginator" => $pager->render()
        ]);
    }

    public function contacts(array $data): void
    {

        $people = (new People())->findById($data['people_id']);

        $peopleContacts = (new PeopleContacts())->find(
            "people_id = :people",
            "people={$people->id}"
        )->fetch(true);

        $count = (new PeopleContacts())->find(
            "people_id = :people",
            "people={$people->id}"
        )->count();

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Proprietários",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/people/contacts", [
            "app" => "people/people",
            "head" => $head,
            "people" => $people,
            "peopleContacts" => $peopleContacts,
            "count" => $count
        ]);
    }
}