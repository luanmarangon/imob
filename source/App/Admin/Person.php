<?php

namespace Source\App\Admin;

use PSpell\Config;
use Source\Models\Auth;
use Source\Models\People;
use Source\Support\Pager;
use Source\App\Admin\Admin;
use Source\Models\Contacts;
use Source\Models\Addresses;
use Source\Models\Properties;
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
        $births = (new People())->find("DATE_FORMAT(datebirth, '%m-%d') BETWEEN DATE_FORMAT(CURRENT_DATE, '%m-%d') AND DATE_FORMAT(DATE_ADD(CURRENT_DATE, INTERVAL 30 DAY), '%m-%d')")->order("datebirth ASC")->fetch(true);
        $birthsCount = (new People())->find("DATE_FORMAT(datebirth, '%m-%d') BETWEEN DATE_FORMAT(CURRENT_DATE, '%m-%d') AND DATE_FORMAT(DATE_ADD(CURRENT_DATE, INTERVAL 30 DAY), '%m-%d')")->count();



        // $lastPeople = (new People())->find()->order("created_at DESC")->limit(9)->fetch(true);
        // $lastCount = (new People())->find("created_at = :c", "c=")->count();

        // $lastPeople = (new People())->find("created_at >= DATE_SUB(NOW(), INTERVAL 720 HOUR)")->order("created_at DESC")->limit(3)->fetch(true);
        // $countPeople = (new People())->find("created_at >= DATE_SUB(NOW(), INTERVAL 720 HOUR)")->order("created_at DESC")->count();
        $lastPeople = (new People())->find("MONTH(created_at) = MONTH(NOW())")->order("created_at DESC")->limit(4)->fetch(true);
        $countPeople = (new People())->find("MONTH(created_at) = MONTH(NOW())")->order("created_at DESC")->count();



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
            "people" => $people,
            "lastPeople" => $lastPeople,
            "countPeople" => $countPeople,
            "births" => $births,
            "birthsCount" => $birthsCount
        ]);
    }

    public function people(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/people/people/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $people = (new People())->find();
        $peopleContacts = (new Contacts())->find()->fetch(true);

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            // $people = (new People())->find("MATCH(first_name, last_name, cpf, rg) AGAINST(:s)", "s={$search}");
            $people = (new People())->find("MATCH(first_name, last_name, cpf, rg) AGAINST(:s) 
                                OR first_name LIKE '%:s%'
                                OR last_name LIKE '%:s%'
                                OR cpf LIKE '%:s%'
                                OR rg LIKE '%:s%'", "s={$search}");
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

    public function peopleCreate(array $data): void
    {

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $query = (new People());
            $cpf = preg_replace("/[^0-9]/", "", $data["document_cpf"]);

            $query->find("cpf = :cpf", "cpf={$cpf}");

            // var_dump($query->count());

            if ($query->count()) {
                $this->message->warning("CPF já cadastrado. Por favor, consulte o CPF informado ou verifique se este cliente já está registrado.")->flash();
                echo json_encode(["redirect" => url("/admin/people/people/{$cpf}/1")]);

                return;
            }

            $personCreate = new People();

            // $personId = $personCreate->lastId();
            $personCreate->first_name = $data["first_name"];
            $personCreate->last_name = $data["last_name"];
            $personCreate->genre = $data["genre"];
            $personCreate->datebirth = date_fmt_back($data["datebirth"]);
            $personCreate->cpf = preg_replace("/[^0-9]/", "", $data["document_cpf"]);
            $personCreate->rg = preg_replace("/[^0-9X]/", "", $data["document_rg"]);

            if (!$personCreate->save()) {
                var_dump($personCreate);
                $json["message"] = $personCreate->message()->render();
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

            if ($data["zipcode"]) {

                //Address
                $address = $data['street'] . ", " . $data['number'] . ", " . $data['complement'] . ", " . $data['district'] . ", " . $data['city'] . ", " . $data['zipcode'];
                $addressCreate = new Addresses();
                $addressCreate->people_id = $personCreate->id;
                $addressCreate->street = ucwords($data["street"]);
                $addressCreate->number = $data["number"];
                $addressCreate->complement = ucwords($data["complement"]);
                $addressCreate->district = ucwords($data["district"]);
                $cityState = explode("-", $data["city"]);
                $addressCreate->city = ucwords($cityState[0]);
                $addressCreate->state = strtoupper($cityState[1]);
                $addressCreate->zipcode = $data["zipcode"];

                $addressAPI = maps_api($address);
                $addressCreate->latitude = $addressAPI['latitude'];
                $addressCreate->longitude = $addressAPI['longitude'];

                if (!$addressCreate->save()) {
                    $json["message"] = $addressCreate->message()->render();
                    echo json_encode($json);
                    return;
                }
            }

            $this->message->success("Cliente cadastrado com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/people/people")]);

            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $personUpdate = (new People())->findById($data["people_id"]);
            // var_dump($data);
            $personUpdate->first_name = $data["first_name"];
            $personUpdate->last_name = $data["last_name"];
            $personUpdate->genre = $data["genre"];
            $personUpdate->datebirth = date_fmt_back($data["datebirth"]);
            $personUpdate->cpf = preg_replace("/[^0-9]/", "", $data["document_cpf"]);
            $personUpdate->rg = preg_replace("/[^0-9X]/", "", $data["document_rg"]);




            if (!$personUpdate->save()) {
                $json["message"] = $personUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Cliente atualizado com sucesso...")->flash();
            echo json_encode(["reload" => true]);

            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $peopleDelete = (new People())->findById($data["people_id"]);

            /**
             * Condição para travar um User->Level menor de inativar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar o perfil desse cliente.")->flash();
                echo json_encode(["redirect" => url("admin/people/people")]);
                return;
            }

            // if (!(Auth::user()->level >= $userDelete->level && $userDelete->level !== 'inativo')) {
            //     $this->message->error("Você não tem permissão de editar o perfil do usuário, pois ele possui nível acima do seu usuário ou está inativo.")->flash();
            //     echo json_encode(["redirect" => url("admin/users/home")]);
            //     return;
            // }

            if (!$peopleDelete) {
                $this->message->error("Você tentou inativar um cliente que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/people/people")]);
                return;
            }

            // if ($userDelete->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}")) {
            //     unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}");
            //     (new Thumb())->flush($userDelete->photo);
            // }

            // $userDelete->destroy();
            $peopleDelete->status = 'Inativo';
            $peopleDelete->save();

            $this->message->success("Cliente inativado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/people/people")]);
            return;
        }

        //ativar
        if (!empty($data["action"]) && $data["action"] == "ativar") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $peopleActivate = (new People())->findById($data["people_id"]);

            /**
             * Condição para travar um User->Level menor de inativar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para ativar o perfil desse Cliente.")->flash();
                echo json_encode(["redirect" => url("admin/people/people")]);
                return;
            }

            // if (!(Auth::user()->level >= $userDelete->level && $userDelete->level !== 'inativo')) {
            //     $this->message->error("Você não tem permissão de editar o perfil do usuário, pois ele possui nível acima do seu usuário ou está inativo.")->flash();
            //     echo json_encode(["redirect" => url("admin/users/home")]);
            //     return;
            // }

            if (!$peopleActivate) {
                $this->message->error("Você tentou Ativar um Cliente que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/people/people")]);
                return;
            }
            $peopleActivate->status = 'Ativo';
            $peopleActivate->save();

            $this->message->success("Cliente Ativado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/people/people")]);
            return;
        }

        $peopleEdit = null;
        if (!empty($data["people_id"])) {
            $peopleId = filter_var($data["people_id"], FILTER_SANITIZE_STRIPPED);
            $peopleEdit = (new People())->findById($peopleId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Proprietários",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/people/people-create", [
            "app" => "people/people",
            "head" => $head,
            "people" => $peopleEdit
            // "people" => $people,
            // "peopleContacts" => $peopleContacts,
            // "count" => $count
        ]);
    }

    public function contacts(array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $people = $data['people_id'];

            //Contacts
            $contact = new Contacts();
            if (!empty($data['phone'])) {
                if (!$contact->createContact($data['contactType'], $data['phone'], $data["people_id"])) {
                    $json["message"] = $contact->message()->render();
                    echo json_encode($json);
                    return;
                }
            }

            if (!empty($data['email'])) {
                if (!$contact->createContact($data['contactType'], $data['email'], $data["people_id"])) {
                    $json["message"] = $contact->message()->render();
                    echo json_encode($json);
                    return;
                }
            }

            $this->message->success("Contato criado com sucesso!")->flash();
            echo json_encode(["redirect" => url("/admin/people/people/{$people}/contacts")]);

            return;
        }


        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $contactDelete = (new Contacts())->findById($data["contacts_id"]);
            // var_dump($data);
            /**
             * Condição para travar um User->Level menor de inativar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Por favor, entre em contato com a administração para solicitar permissão para realizar essa operação de inativar.")->flash();
                echo json_encode(["redirect" => url("/admin/people/people")]);
                return;
            }

            if (!$contactDelete) {
                $this->message->error("Ação inválida. O contato que você tentou inativar não existe ou já foi removido.")->flash();
                echo json_encode(["redirect" => url("/admin/people/people")]);
                return;
            }

            // if ($userDelete->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}")) {
            //     unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}");
            //     (new Thumb())->flush($userDelete->photo);
            // }

            // $userDelete->destroy();
            $contactDelete->status = 'Inativo';
            $contactDelete->save();

            $this->message->success("Contato excluído com sucesso!")->flash();

            echo json_encode(["redirect" => url("/admin/people/people")]);
            return;
        }

        //ativar
        if (!empty($data["action"]) && $data["action"] == "active") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $contactActive = (new Contacts())->findById($data["contacts_id"]);
            // var_dump($data);
            /**
             * Condição para travar um User->Level menor de inativar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Por favor, entre em contato com a administração para solicitar permissão para realizar essa operação de inativar.")->flash();
                echo json_encode(["redirect" => url("/admin/people/people")]);
                return;
            }

            if (!$contactActive) {
                $this->message->error("Ação inválida. O contato que você tentou inativar não existe ou já foi removido.")->flash();
                echo json_encode(["redirect" => url("/admin/people/people")]);
                return;
            }

            // if ($userDelete->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}")) {
            //     unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}");
            //     (new Thumb())->flush($userDelete->photo);
            // }

            // $userDelete->destroy();
            $contactActive->status = 'Ativo';
            $contactActive->save();

            $this->message->success("Contato ativado com sucesso!")->flash();

            echo json_encode(["redirect" => url("/admin/people/people")]);
            return;
        }





        $peopleEdit = null;
        if (!empty($data["people_id"])) {
            $peopleId = filter_var($data["people_id"], FILTER_SANITIZE_STRIPPED);
            $peopleEdit = (new People())->findById($peopleId);
        }

        $peopleContacts = (new Contacts())->find(
            "people_id = :people",
            "people={$peopleEdit->id}"
        );

        $count = (new Contacts())->find(
            "people_id = :people",
            "people={$peopleEdit->id}"
        )->count();

        //search redirect
        // if (!empty($data["s"])) {
        //     $s = str_search($data["s"]);
        //     echo json_encode(["redirect" => url("/admin/people/people/{$s}/1")]);
        //     return;
        // }

        //read
        // $search = null;
        // $people = (new People())->find();
        // $peopleContacts = (new Contacts())->find();

        // if (!empty($data["search"]) && str_search($data["search"]) != "all") {
        //     $search = str_search($data["search"]);
        //     $people = (new People())->find("MATCH(first_name, last_name, cpf, rg) AGAINST(:s)", "s={$search}");
        //     if (!$people->count()) {
        //         $this->message->info("Sua pesquisa não retornou resultados")->flash();
        //         redirect("/admin/people/people");
        //     }
        // }
        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/people/people/{$peopleId}/contacts/{$all}/"));
        $pager->pager($count, 6, (!empty($data["page"]) ? $data["page"] : 1));



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
            "people" => $peopleEdit,
            "peopleContacts" => $peopleContacts->limit($pager->limit())->offset($pager->offset())->order("created_at")->fetch(true),
            // "peopleContacts" => $peopleContacts,
            "count" => $count,
            "paginator" => $pager->render()
            // "people" => $people->limit($pager->limit())->offset($pager->offset())->order("first_name, last_name")->fetch(true),


        ]);
    }
}
