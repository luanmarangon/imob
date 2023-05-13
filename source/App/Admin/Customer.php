<?php

namespace Source\App\Admin;


use Source\Models\leads;
use Source\Models\People;
use Source\Support\Pager;
use Source\Models\Clients;
use Source\App\Admin\Admin;
use Source\Models\Contacts;
use Source\Models\Addresses;
use Source\Models\ClientsContacts;

class Customer extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $leads = (new Leads())->find()->count();
        $countClients = (new Leads())->find("status = :status", "status=Convertido")->count();
        $lastLeads = (new Leads())->find("status = 'lead' AND MONTH(created_at) = MONTH(NOW())")->order("created_at DESC")->limit(3)->fetch(true);
        $countLeads = (new Leads())->find("status = 'lead' AND MONTH(created_at) = MONTH(NOW())")->order("created_at DESC")->count();

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/leads/home", [
            "app" => "clients/home",
            "head" => $head,
            "leads" => $leads,
            "countClients" => $countClients,
            "lastLeads" => $lastLeads,
            "countLeads" => $countLeads

        ]);
    }

    // public function customers()
    // {
    //     $head = $this->seo->render(
    //         CONF_SITE_NAME . " | Imóveis",
    //         CONF_SITE_DESC,
    //         url("/admin"),
    //         theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
    //         false
    //     );

    //     echo $this->view->render("widgets/clients/client", [
    //         "app" => "clients/client",
    //         "head" => $head,


    //     ]);
    // }

    // public function clients(?array $data): void
    // {

    //     //search redirect
    //     if (!empty($data["s"])) {
    //         $s = str_search($data["s"]);
    //         echo json_encode(["redirect" => url("/admin/clients/client/{$s}/1")]);
    //         return;
    //     }

    //     //read
    //     $search = null;
    //     $clients = (new Clients())->find();
    //     $clientsContacts = (new ClientsContacts())->find()->fetch(true);

    //     if (!empty($data["search"]) && str_search($data["search"]) != "all") {
    //         $search = str_search($data["search"]);
    //         $clients     = (new Clients())->find("MATCH(first_name, last_name, rg, cpf) AGAINST(:s)", "s={$search}");
    //         if (!$clients->count()) {
    //             $this->message->info("Sua pesquisa não retornou resultados")->flash();
    //             redirect("/admin/clients/client");
    //         }
    //     }
    //     $all = ($search ?? "all");
    //     $pager = new Pager(url("/admin/clients/client/{$all}/"));
    //     $pager->pager($clients->count(), 4, (!empty($data["page"]) ? $data["page"] : 1));

    //     $head = $this->seo->render(
    //         CONF_SITE_NAME . " | Imóveis",
    //         CONF_SITE_DESC,
    //         url("/admin"),
    //         theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
    //         false
    //     );

    //     echo $this->view->render("widgets/clients/client", [
    //         "app" => "clients/client",
    //         "head" => $head,
    //         "clients" => $clients->limit($pager->limit())->offset($pager->offset())->order("created_at")->fetch(true),
    //         "clientsContacts" => $clientsContacts,
    //         "search" => $search,
    //         "paginator" => $pager->render()


    //     ]);
    // }

    // public function clientContacts(array $data): void
    // {
    //     $clients = (new Clients())->findById($data['clients_id']);

    //     $clientsContacts = (new ClientsContacts())->find(
    //         "clients_id = :clients",
    //         "clients={$clients->id}"
    //     )->fetch(true);

    //     $count = (new ClientsContacts())->find(
    //         "clients_id = :clients",
    //         "clients={$clients->id}"
    //     )->count();

    //     $head = $this->seo->render(
    //         CONF_SITE_NAME . " | Proprietários",
    //         CONF_SITE_DESC,
    //         url("/admin"),
    //         theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
    //         false
    //     );

    //     echo $this->view->render("widgets/leads/contacts", [
    //         "app" => "clients/client",
    //         "head" => $head,
    //         "clients" => $clients,
    //         "clientsContacts" => $clientsContacts,
    //         "count" => $count
    //     ]);
    // }

    public function leads(?array $data): void
    {

        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/leads/leads/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $leads = (new leads())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $leads = (new leads())->find("MATCH(full_name, email, phone) AGAINST(:s)", "s={$search}");
            if (!$leads->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/leads/leads");
            }
        }
        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/leads/leads/{$all}/"));
        $pager->pager($leads->count(), 4, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/leads/leads", [
            "app" => "leads/leads",
            "head" => $head,
            "leads" => $leads->limit($pager->limit())->offset($pager->offset())->order("created_at")->fetch(true),
            "search" => $search,
            "paginator" => $pager->render()


        ]);
    }
    public function convert(?array $data): void
    {
        //Lead
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $convert = (new leads())->findById($data['leads_id']);

        //Salvando com People
        //create
        if (!empty($data["action"]) && $data["action"] == "convert") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $personCreate = new People();
            $personId = $personCreate->lastId();
            $personCreate->first_name = $data["first_name"];
            $personCreate->last_name = $data["last_name"];
            $personCreate->genre = $data["genre"];
            $personCreate->birth = date_fmt_back($data["datebirth"]);
            $personCreate->cpf = preg_replace("/[^0-9]/", "", $data["document_cpf"]);
            $personCreate->rg = preg_replace("/[^0-9X]/", "", $data["document_rg"]);

            //Address
            $address = $data['street'] . ", " . $data['number'] . ", " . $data['complement'] . ", " . $data['district'] . ", " . $data['city'] . ", " . $data['zipcode'];
            $addressCreate = new Addresses();
            $addressCreate->people_id = $personId;
            $addressCreate->street = $data["street"];
            $addressCreate->number = $data["number"];
            $addressCreate->complement = $data["complement"];
            $addressCreate->district = $data["district"];
            $cityState = explode("-", $data["city"]);
            $addressCreate->city = $cityState[0];
            $addressCreate->state = $cityState[1];
            $addressCreate->zipcode = $data["zipcode"];

            $addressAPI = maps_api($address);
            $addressCreate->latitude = $addressAPI['latitude'];
            $addressCreate->longitude = $addressAPI['longitude'];

            if (!$personCreate->save()) {
                $json["message"] = $personCreate->message()->render();
                echo json_encode($json);
                return;
            }
            if (!$addressCreate->save()) {
                $json["message"] = $addressCreate->message()->render();
                echo json_encode($json);
                return;
            }

            //Contacts
            $contact = new Contacts();
            if (!empty($data['phone'])) {
                if (!$contact->createContact("WhatsApp", $data['phone'], $personCreate->id)) {
                    $json["message"] = $contact->message()->render();
                    echo json_encode($json);
                    return;
                }
            }

            if (!empty($data['email'])) {
                if (!$contact->createContact("E-mail", $data['email'], $personCreate->id)) {
                    $json["message"] = $contact->message()->render();
                    echo json_encode($json);
                    return;
                }
            }

            //Convertido
            // $lead = (new leads())->findById($convert);
            $convert->status = "Convertido";
            $convert->save();

            $this->message->success("Cliente cadastrado com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/people/people")]);

            return;
        }


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Cliente",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/leads/convert", [
            "app" => "people/people",
            "head" => $head,
            "convert" => $convert,
            // "convert" => $convert


        ]);
    }
}