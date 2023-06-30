<?php

namespace Source\App\Admin;

use Source\Support\Pager;
use Source\App\Admin\Admin;
use Source\Models\Addresses;
use Source\Models\Category;
use Source\Models\Charge;
use Source\Models\Comfortable;
use Source\Models\Features;
use Source\Models\People;
use Source\Models\Properties;
use Source\Models\PropertiesComfortable;
use Source\Models\PropertiesFeatures;
use Source\Models\PropertiesStructures;
use Source\Models\Structures;
use Source\Models\Transactions;
use Source\Models\Tributes;
use Source\Models\Type;

class Propertie extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $properties = (new Properties())->find()->count();
        $activesProperties = (new Properties())->find(
            "active = :active",
            "active=1"
        )->count();


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/properties/home", [
            "app" => "properties/home",
            "head" => $head,
            "properties" => $properties,
            "activesProperties" => $activesProperties
        ]);
    }

    public function properties(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            // redirect("/admin/properties/properties/{$s}/1");
            echo json_encode(["redirect" => url("/admin/properties/properties/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $properties = (new Properties())->find();
        $people = (new People())->find()->fetch(true);


        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $properties = (new Properties())->find("MATCH(reference) AGAINST(:s)", "s={$search}");
            if (!$properties->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/properties/properties");
            }
        }
        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/properties/properties/{$all}/"));
        $pager->pager($properties->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));

        // var_dump($data["page"]);

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/properties/properties", [
            "app" => "properties/properties",
            "head" => $head,
            "search" => $search,
            "properties" => $properties->limit($pager->limit())->offset($pager->offset())->order("updated_at")->fetch(true),
            "people" => $people,
            "paginator" => $pager->render()
        ]);
    }

    public function propertiesCreate(?array $data): void
    {
        $peoples = (new People())->find()->fetch(true);
        $categories = (new Category())->find()->fetch(true);
        $types = (new Type())->find()->fetch(true);
        $comfortable = (new Comfortable())->find()->fetch(true);
        $features = (new Features())->find()->fetch(true);
        $structures = (new Structures())->find()->fetch(true);
        $charge = (new Charge())->find()->fetch(true);


        // $propertie = (new Properties())->find()->fetch(true);
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            /**Incio Address */
            $addressCreate = new Addresses();
            $addressCreate->people_id = $data["people"];
            $addressCreate->street = $data["street"];
            $addressCreate->number = $data["number"];
            $addressCreate->complement = $data["complement"];
            $addressCreate->district = $data["district"];

            $parts = explode("-", $data["city"]); // Separar a cidade e o estado pelo hífen
            $city = $parts[0]; // Obter a cidade
            $state = $parts[1]; // Obter o estado

            $addressCreate->city = $city;
            $addressCreate->state = $state;
            $addressCreate->zipcode = $data["cep"];

            $address = $addressCreate->street . ", "  .
                $addressCreate->number . ", " .
                $addressCreate->complement . ", "  .
                $addressCreate->district . ", "  .
                $addressCreate->city . ", "  .
                $addressCreate->state . ", "  .
                $addressCreate->zipcode;

            $addressAPI = maps_api($address);
            $addressCreate->latitude = $addressAPI['latitude'];
            $addressCreate->longitude = $addressAPI['longitude'];

            /**Fim Address */

            /**Inicio Propertie */
            $propertieCreate = new Properties();
            $propertieCreate->addresses_id = $addressCreate->lastId();
            $propertieCreate->categories_id = $data['category'];
            $propertieCreate->types_id = $data['type'];

            /**Reference */
            $propertieId = $propertieCreate->lastId();
            $propertieCreate->reference = "IMOB" . sprintf("%03d", $propertieId);

            /**Description */
            $propertieCreate->description = $data['description'];
            $propertieCreate->active = 1;
            /**Fim Propertie */

            /**Incio Comfortable */
            /**Criar testes */
            $propertieComfortableCreate = new PropertiesComfortable();
            $comfortablePropertie = [];
            $comfortableQuantity = [];

            $i = 0;
            while (isset($data['comfortable'][$i]) && isset($data['quantityComfortable'][$i])) {
                if (!empty($data['comfortable'][$i]) && !empty($data['quantityComfortable'][$i])) {
                    $comfortable = $data['comfortable'][$i];
                    $quantity = $data['quantityComfortable'][$i];

                    // Verificar se o valor já existe no array
                    if (!in_array($comfortable, $comfortablePropertie)) {
                        $comfortablePropertie[] = $comfortable;
                        $comfortableQuantity[] = $quantity;
                    }
                }
                $i++;
            }

            foreach ($comfortablePropertie as $index => $comfortable) {
                $quantity = $comfortableQuantity[$index];
                $propertieComfortableCreate->properties_id = $propertieId;
                $propertieComfortableCreate->comfortable_id = $comfortable;
                $propertieComfortableCreate->quantity = $quantity;
                // var_dump($propertieComfortableCreate);
            }
            /**Fim Comfortable */

            /**Inicio Structures */
            $propertieStructuresCreate = new PropertiesStructures();
            $structuresPropertie = [];
            $structuresFootage = [];

            $i = 0;
            while (isset($data['structure'][$i]) && isset($data['footageStructure'][$i])) {
                if (!empty($data['structure'][$i]) && !empty($data['footageStructure'][$i])) {
                    $structure = $data['structure'][$i];
                    $footage = $data['footageStructure'][$i];

                    // Verificar se o valor já existe no array
                    if (!in_array($structure, $structuresPropertie)) {
                        $structuresPropertie[] = $structure;
                        $structuresFootage[] = $footage;
                    }
                }
                $i++;
            }

            foreach ($structuresPropertie as $index => $structures) {
                $footage = $structuresFootage[$index];
                $propertieStructuresCreate->properties_id = $propertieId;
                $propertieStructuresCreate->structures_id = $structures;
                $propertieStructuresCreate->footage = $footage;
            }
            /**Fim Structures */

            /**inicio Tributes */
            $propertieTributesCreate = new Tributes();
            $tributesData = [];

            $i = 0;
            while (isset($data['tribute'][$i]) && isset($data['yearTribute'][$i]) && isset($data['valueTribute'][$i])) {
                if (!empty($data['tribute'][$i]) && !empty($data['yearTribute'][$i]) && !empty($data['valueTribute'][$i])) {
                    $tribute = $data['tribute'][$i];
                    $exercise = $data['yearTribute'][$i];
                    $value = $data['valueTribute'][$i];

                    $tributesData[] = [
                        'tribute' => $tribute,
                        'exercise' => $exercise,
                        'value' => $value,
                    ];
                }
                $i++;
            }

            foreach ($tributesData as $tributeData) {
                $propertieTributesCreate->properties_id = $propertieId;
                $propertieTributesCreate->charges_id = $tributeData['tribute'];
                $propertieTributesCreate->exercise = $tributeData['exercise'];
                $propertieTributesCreate->value = $tributeData['value'];
            }
            /**Fim Tributes */

            /**Inicio Features */
            $propertieFeaturesCreate = new PropertiesFeatures();
            $featuresData = [];

            $featuresData[] = $data['feature'];

            foreach ($featuresData as $feature) {
                $propertieFeaturesCreate->properties_id = $propertieId;
                $propertieFeaturesCreate->features_id = $feature;
                // var_dump($propertieFeaturesCreate);
            }
            /**Fim Features */

            if (!$addressCreate->save()) {
                $json["message"] = $addressCreate->message()->render();
                echo json_encode($json);
                return;
            }
            if (!$propertieCreate->save()) {
                $json["message"] = $propertieCreate->message()->render();
                echo json_encode($json);
                return;
            }


            if (!$propertieComfortableCreate->save()) {
                var_dump($propertieComfortableCreate);
                $json["message"] = $propertieComfortableCreate->message()->render();
                echo json_encode($json);
                return;
            }
            echo "aqui";
            // if (!$propertieStructuresCreate->save()) {
            //     $json["message"] = $propertieStructuresCreate->message()->render();
            //     echo json_encode($json);
            //     return;
            // }

            // if (!$propertieTributesCreate->save()) {
            //     // var_dump($propertieTributesCreate);
            //     $json["message"] = $propertieTributesCreate->message()->render();
            //     echo json_encode($json);
            //     return;
            // }

            // if (!$propertieFeaturesCreate->save()) {
            //     $json["message"] = $propertieFeaturesCreate->message()->render();
            //     echo json_encode($json);
            //     return;
            // }

            $this->message->success("Imovel cadastrado com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/properties/properties/{$propertieCreate->id}")]);

            return;
        }
        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            // $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            // $userUpdate = (new User())->findById($data["user_id"]);

            // /**
            //  * Condição para travar um User->Level menor de alterar os dados de um User->Level maior
            //  */
            // if (Auth::user()->level < 10 || $userUpdate->level != 'Inativo') {
            //     if (Auth::user()->level < $userUpdate->level) {
            //         $this->message->error("Você não tem permissão de editar o perfil do usuário, pois ele possui nível acima do seu usuário")->flash();
            //         echo json_encode(["redirect" => url("admin/users/home")]);
            //         return;
            //     }
            // }

            // if (!$userUpdate) {
            //     $this->message->error("Você tentou gerenciar um usuário que não existe ou foi removido")->flash();
            //     echo json_encode(["redirect" => url("admin/users/home")]);
            //     return;
            // }

            // $userUpdate->first_name = $data["first_name"];
            // $userUpdate->last_name = $data["last_name"];
            // $userUpdate->email = $data["email"];
            // $userUpdate->password = (!empty($data["password"]) ? $data["password"] : $userUpdate->password);
            // $userUpdate->level = $data["level"];
            // $userUpdate->genre = $data["genre"];
            // $userUpdate->office = $data["office"];
            // $userUpdate->datebirth = date_fmt_back($data["datebirth"]);
            // $userUpdate->document = preg_replace("/[^0-9]/", "", $data["document"]);
            // $userUpdate->status = $data["status"];

            // //upload cover
            // if (!empty($_FILES["photo"])) {
            //     if ($userUpdate->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userUpdate->photo}")) {
            //         unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userUpdate->photo}");
            //         (new Thumb())->flush($userUpdate->photo);
            //     }

            //     $files = $_FILES["photo"];
            //     $upload = new Upload();
            //     $image = $upload->image($files, $userUpdate->fullName(), 600);

            //     if (!$image) {
            //         $json["message"] = $upload->message()->render();
            //         echo json_encode($json);
            //         return;
            //     }

            //     $userUpdate->photo = $image;
            // }
            // if (!$userUpdate->save()) {
            //     $json["message"] = $userUpdate->message()->render();
            //     echo json_encode($json);
            //     return;
            // }

            // $this->message->success("Usuário atualizado com sucesso...")->flash();
            // echo json_encode(["reload" => true]);

            // return;
        }


        $propertieEdit = null;
        if (!empty($data["user_id"])) {
            $propertieId = filter_var($data["propertie_id"], FILTER_SANITIZE_STRIPPED);
            $userEdit = (new Properties())->findById($propertieId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/properties/properties-create", [
            "app" => "properties/properties-create",
            "head" => $head,
            "peoples" => $peoples,
            "categories" => $categories,
            "types" => $types,
            "comfortable" => $comfortable,
            "features" => $features,
            "structures" => $structures,
            "charge" => $charge,
            "propertie" => $propertieEdit
        ]);
    }



    public function details(array $data): void
    {

        $propertie = (new Properties())->find(
            "reference = :reference",
            "reference={$data["reference"]}"
        )->fetch();

        $propertieComfortable = (new PropertiesComfortable())->findByProperties($propertie->id)->fetch(true);
        $countComfortable = (new PropertiesComfortable())->findByProperties($propertie->id)->count();

        $propertieFeatures = (new PropertiesFeatures())->findByProperties($propertie->id)->fetch(true);
        $countFeatures = (new PropertiesFeatures())->findByProperties($propertie->id)->count();

        $propertieStructures = (new PropertiesStructures())->findByProperties($propertie->id)->fetch(true);

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/properties/details/home", [
            "app" => "properties/properties/{$propertie->reference}/details/home",
            "head" => $head,
            "propertie" => $propertie,
            "propertieComfortable" => $propertieComfortable,
            "countComfortable" => $countComfortable,
            "propertieFeatures"  => $propertieFeatures,
            "countFeatures" => $countFeatures,
            "propertieStructures"  => $propertieStructures
        ]);
    }

    public function detailsComfortable(array $data): void
    {

        $propertie = (new Properties())->find(
            "reference = :reference",
            "reference={$data["reference"]}"
        )->fetch();

        $propertieComfortable = (new PropertiesComfortable())->findByProperties($propertie->id)->fetch(true);
        $countComfortable = (new PropertiesComfortable())->findByProperties($propertie->id)->count();

        $propertieFeatures = (new PropertiesFeatures())->findByProperties($propertie->id)->fetch(true);
        $countFeatures = (new PropertiesFeatures())->findByProperties($propertie->id)->count();

        $propertieStructures = (new PropertiesStructures())->findByProperties($propertie->id)->fetch(true);

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/properties/details/comfortable", [
            "app" => "properties/properties/{$propertie->reference}/details/comfortable",
            "head" => $head,
            "propertie" => $propertie,
            "propertieComfortable" => $propertieComfortable,
            "countComfortable" => $countComfortable,
            "propertieFeatures"  => $propertieFeatures,
            "countFeatures" => $countFeatures,
            "propertieStructures"  => $propertieStructures
        ]);
    }

    public function detailsFeatures(array $data): void
    {

        $propertie = (new Properties())->find(
            "reference = :reference",
            "reference={$data["reference"]}"
        )->fetch();

        $propertieComfortable = (new PropertiesComfortable())->findByProperties($propertie->id)->fetch(true);
        $countComfortable = (new PropertiesComfortable())->findByProperties($propertie->id)->count();

        $propertieFeatures = (new PropertiesFeatures())->findByProperties($propertie->id)->fetch(true);
        $countFeatures = (new PropertiesFeatures())->findByProperties($propertie->id)->count();

        $propertieStructures = (new PropertiesStructures())->findByProperties($propertie->id)->fetch(true);

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/properties/details/features", [
            "app" => "properties/properties/{$propertie->reference}/details/features",
            "head" => $head,
            "propertie" => $propertie,
            "propertieComfortable" => $propertieComfortable,
            "countComfortable" => $countComfortable,
            "propertieFeatures"  => $propertieFeatures,
            "countFeatures" => $countFeatures,
            "propertieStructures"  => $propertieStructures
        ]);
    }

    public function detailsStrucutures(array $data): void
    {
        // //search redirect
        // if (!empty($data["s"])) {
        //     $s = str_search($data["s"]);
        //     redirect("/admin/properties/properties/{$s}/1");
        //     // echo json_encode(["redirect" => url("/admin/people/people/{$s}/1")]);
        //     return;
        // }

        // //read
        // $search = null;
        // $structures = (new Structures())->find();

        $propertie = (new Properties())->find(
            "reference = :reference",
            "reference={$data["reference"]}"
        )->fetch();

        $propertieComfortable = (new PropertiesComfortable())->findByProperties($propertie->id)->fetch(true);
        $countComfortable = (new PropertiesComfortable())->findByProperties($propertie->id)->count();

        $propertieFeatures = (new PropertiesFeatures())->findByProperties($propertie->id)->fetch(true);
        $countFeatures = (new PropertiesFeatures())->findByProperties($propertie->id)->count();

        $propertieStructures = (new PropertiesStructures())->findByProperties($propertie->id)->fetch(true);

        // if (!empty($data["search"]) && str_search($data["search"]) != "all") {
        //     $search = str_search($data["search"]);
        //     $structures = (new Structures())->find("MATCH(structure) AGAINST(:s)", "s={$search}");
        //     if (!$structures->count()) {
        //         $this->message->info("Sua pesquisa não retornou resultados")->flash();
        //         redirect("/properties/properties/{$propertie->reference}/details/structures");
        //     }
        // }

        // $all = ($search ?? "all");
        // $pager = new Pager(url("/properties/properties/{$propertie->reference}/details/structures/{$all}/"));
        // $pager->pager($structures->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));
        // var_dump(
        //     $structures,
        //     $data,
        //     $pager,
        //     $propertie->reference
        // );

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/properties/details/structures", [
            "app" => "properties/properties/{$propertie->reference}/details/structures",
            "head" => $head,
            "propertie" => $propertie,
            "propertieComfortable" => $propertieComfortable,
            "countComfortable" => $countComfortable,
            "propertieFeatures"  => $propertieFeatures,
            "countFeatures" => $countFeatures,
            "propertieStructures"  => $propertieStructures,
            // "search" => $search,
            // "paginator" => $pager->render()

        ]);
    }

    public function transactions(array $data): void
    {

        $propertie = (new Properties())->find(
            "reference = :reference",
            "reference={$data["reference"]}"
        )->fetch();

        $transactions = (new Transactions())->findTransactionsProperti($propertie->id)->fetch(true);
        $people = (new People())->find()->fetch(true);

        // var_dump($owners);


        // $propertieComfortable = (new PropertiesComfortable())->findByProperties($propertie->id)->fetch(true);
        // $countComfortable = (new PropertiesComfortable())->findByProperties($propertie->id)->count();

        // $propertieFeatures = (new PropertiesFeatures())->findByProperties($propertie->id)->fetch(true);
        // $countFeatures = (new PropertiesFeatures())->findByProperties($propertie->id)->count();

        // $propertieStructures = (new PropertiesStructures())->findByProperties($propertie->id)->fetch(true);

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/properties/transactions/transactions", [
            "app" => "properties/transactions/transactions",
            "head" => $head,
            "propertie" => $propertie,
            "transactions" => $transactions,
            "people" => $people
            // "propertieComfortable" => $propertieComfortable,
            // "countComfortable" => $countComfortable,
            // "propertieFeatures"  => $propertieFeatures,
            // "countFeatures" => $countFeatures,
            // "propertieStructures"  => $propertieStructures
        ]);
    }
}