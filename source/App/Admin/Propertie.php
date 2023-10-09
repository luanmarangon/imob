<?php

namespace Source\App\Admin;

use Source\Models\Auth;
use Source\Models\Type;
use Source\Models\Charge;
use Source\Models\People;
use Source\Support\Pager;
use Source\App\Admin\Admin;
use Source\Models\Category;
use Source\Models\Features;
use Source\Models\Tributes;
use Source\Models\Addresses;
use Source\Models\Properties;
use Source\Models\Structures;
use Source\Models\Comfortable;
use Source\Models\Transactions;
use Source\Models\PropertiesFeatures;
use Source\Models\PropertiesStructures;
use Source\Models\PropertiesComfortable;

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


        // Teste
        // $teste = new PropertiesComfortable();
        // $teste->properties_id = 10;
        // $teste->comfortable_id = 1;
        // $teste->quantity = 2;
        // $teste->reference = "LUAN";
        // $teste->description = "Teste Home";
        // $teste->active = 1;

        // var_dump($teste);

        // $teste->save();
        // var_dump($teste);





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
            // var_dump($search);
            // exit();
            $properties = (new Properties())->find("MATCH(reference) AGAINST(:s)", "s={$search}");
            // $address = (new Addresses())->find("MATCH(zipcode) AGAINST(:s)", "s={$search}");
            // var_dump($address);
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
            "properties" => $properties->limit($pager->limit())->offset($pager->offset())->order("active ASC")->fetch(true),
            // "address" => $address->limit($pager->limit())->offset($pager->offset())->order("updated_at")->fetch(true),
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

            $queryAddresses = (new Addresses())->find("latitude = :lat and longitude = :log", "lat={$addressCreate->latitude}&log={$addressCreate->longitude}")->fetch(true);

            // trava para nao duplicar endereço
            // if ($queryAddresses) {
            //     $this->message->warning("Endereço já cadastrado. Por favor, consulte o endereço antes de cadastrá-lo.")->flash();
            //     echo json_encode(["redirect" => url("/admin/properties/properties")]);
            //     return;
            // }

            if (!$addressCreate->save()) {
                $json["message"] = $addressCreate->message()->render();
                echo json_encode($json);
                return;
            }
            /**Fim Address */

            /**Inicio Propertie */
            $propertieCreate = new Properties();
            // $propertieCreate->addresses_id = $addressCreate->lastId();
            $propertieCreate->addresses_id = $addressCreate->id;
            $propertieCreate->categories_id = $data['category'];
            $propertieCreate->types_id = $data['type'];

            /**Reference */
            // ajustar isso pois ira pegar o ultimo ID se houver destroy irá gerar value diferente
            $propertieId = $propertieCreate->lastId();
            $propertieCreate->reference = "IMOB" . sprintf("%03d", $propertieId);

            /**Description */
            $propertieCreate->description = $data['description'];
            $propertieCreate->active = 1;


            if (!$propertieCreate->save()) {
                $addressCreate->destroy();
                $json["message"] = $propertieCreate->message()->render();
                echo json_encode($json);
                return;
            }
            /**Fim Propertie */

            /**   VALIDADO ATÉ AQUI               ^ */
            /**Minimo para cadastrar um Propertie |*/

            /**Incio Comfortable */
            if (!empty($data['comfortable'])) {
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
                    $propertieComfortableCreate = new PropertiesComfortable(); // Criar uma nova instância para cada registro
                    $quantity = $comfortableQuantity[$index];
                    $propertieComfortableCreate->properties_id = $propertieCreate->id;
                    $propertieComfortableCreate->comfortable_id = $comfortable;
                    $propertieComfortableCreate->quantity = $quantity;

                    if (!$propertieComfortableCreate->save()) {
                        $json["message"] = $propertieComfortableCreate->message()->render();
                        echo json_encode($json);
                        return;
                    }
                }
            }
            /**Fim Comfortable */

            /**Inicio Structures */
            if (!empty($data['structure'])) {
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
                    $propertieStructuresCreate = new PropertiesStructures();
                    $footage = $structuresFootage[$index];
                    $propertieStructuresCreate->properties_id = $propertieCreate->id;
                    $propertieStructuresCreate->structures_id = $structures;
                    $propertieStructuresCreate->footage = $footage;

                    if (!$propertieStructuresCreate->save()) {
                        $json["message"] = $propertieStructuresCreate->message()->render();
                        echo json_encode($json);
                        return;
                    }
                }
            }
            /**Fim Structures */

            /**inicio Tributes */
            if (!empty($data['tribute'])) {
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
                    $propertieTributesCreate = new Tributes();
                    $propertieTributesCreate->properties_id = $propertieCreate->id;
                    $propertieTributesCreate->charges_id = $tributeData['tribute'];
                    $propertieTributesCreate->exercise = $tributeData['exercise'];
                    $propertieTributesCreate->value = $tributeData['value'];

                    if (!$propertieTributesCreate->save()) {
                        // var_dump($propertieTributesCreate);
                        $json["message"] = $propertieTributesCreate->message()->render();
                        echo json_encode($json);
                        return;
                    }
                }
            }
            /**Fim Tributes */

            // /**Inicio Features */
            if (!empty($data['feature'])) {
                $featurePropertie = [];

                $i = 0;
                while (isset($data['feature'][$i])) {
                    if (!empty($data['feature'][$i])) {
                        $feature = $data['feature'][$i];

                        // Verificar se o valor já existe no array
                        if (!in_array($feature, $featurePropertie)) {
                            $featurePropertie[] = $feature;
                        }
                    }
                    $i++;
                }

                foreach ($featurePropertie as $index => $feature) {
                    $propertieFeatureCreate = new PropertiesFeatures();
                    $propertieFeatureCreate->properties_id = $propertieCreate->id;
                    $propertieFeatureCreate->features_id = $feature;

                    if (!$propertieFeatureCreate->save()) {
                        $json["message"] = $propertieFeatureCreate->message()->render();
                        echo json_encode($json);
                        return;
                    }
                }
            }
            /**Fim Features */

            $this->message->success("Imovel cadastrado com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/properties/properties/{$propertieCreate->reference}/1")]);
            return;
        }
        //update
        if (!empty($data["action"]) && $data["action"] == "update") {

            // var_dump($data);
            // echo "aqui";
            // var_dump($data['propertie_id']);

            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $propertieUpdate = (new Properties())->findById($data['propertie_id']);
            $addressUpdate = (new Addresses())->findById($propertieUpdate->addresses_id);

            $addressUpdate->zipcode = $data['zipcode'];
            $parts = explode("-", $data["city"]); // Separar a cidade e o estado pelo hífen

            $city = $parts[0]; // Obter a cidade
            $state = $parts[1]; // Obter o estado

            $addressUpdate->city = $city;
            $addressUpdate->state = $state;

            // $addressUpdate->city = $data['city'];


            $addressUpdate->district = $data['district'];
            $addressUpdate->street = $data['street'];
            $addressUpdate->number = $data['number'];
            $addressUpdate->complement = $data['complement'];

            $address = $addressUpdate->street . ", "  .
                $addressUpdate->number . ", " .
                $addressUpdate->complement . ", "  .
                $addressUpdate->district . ", "  .
                $addressUpdate->city . ", "  .
                $addressUpdate->state . ", "  .
                $addressUpdate->zipcode;

            $addressAPI = maps_api($address);
            $addressUpdate->latitude = $addressAPI['latitude'];
            $addressUpdate->longitude = $addressAPI['longitude'];

            // var_dump($addressUpdate);
            // exit();
            //     // }
            if (!$addressUpdate->save()) {
                $json["message"] = $addressUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Imóvel atualizado com sucesso...")->flash();
            echo json_encode(["reload" => true]);

            return;
        }
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $propertieDelete = (new Properties())->findById($data['propertie_id']);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level <= 5) {
                $this->message->error("Você não tem permissão para Inativar o Imóvel.")->flash();
                echo json_encode(["redirect" => url("admin/users/home")]);
                return;
            }

            if (!$propertieDelete) {
                $this->message->error("Você tentou Inativar um Imóvel que já foi inativado")->flash();
                echo json_encode(["redirect" => url("/admin/properties/properties")]);
                return;
            }

            $propertieDelete->active = 'Inativo';
            // $propertieDelete->save();

            if (!$propertieDelete->save()) {
                $json["message"] = $propertieDelete->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Imóvel Inativado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/properties/properties")]);
            return;
        }

        if (!empty($data["action"]) && $data["action"] == "ativar") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $propertieAtivar = (new Properties())->findById($data['propertie_id']);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level <= 5) {
                $this->message->error("Você não tem permissão para Ativar o Imóvel.")->flash();
                echo json_encode(["redirect" => url("admin/users/home")]);
                return;
            }

            if (!$propertieAtivar) {
                $this->message->error("Você tentou Inativar um Imóvel que já foi inativado")->flash();
                echo json_encode(["redirect" => url("/admin/properties/properties")]);
                return;
            }

            $propertieAtivar->active = 'Ativo';
            // $propertieAtivar->save();

            if (!$propertieAtivar->save()) {
                $json["message"] = $propertieAtivar->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Imóvel Ativado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/properties/properties")]);
            return;
        }




        // var_dump($data);
        $propertieEdit = null;
        if (!empty($data["propertie_id"])) {
            $propertieId = filter_var($data["propertie_id"], FILTER_SANITIZE_STRIPPED);
            $propertieEdit = (new Properties())->findById($propertieId);
            // var_dump($propertieId);
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
        $comfortable = (new Comfortable())->find("id NOT IN (SELECT DISTINCT comfortable_id FROM properties_comfortable WHERE properties_id = {$propertie->id})")->fetch(true);
        $propertieComfortable = (new PropertiesComfortable())->findByProperties($propertie->id)->fetch(true);

        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $propertie = (new Properties())->find(
                "reference = :reference",
                "reference={$data["reference"]}"
            )->fetch();
            // var_dump($propertie);
            // exit();

            $propertieComfortable = (new PropertiesComfortable());

            $propertieComfortable->properties_id = $propertie->id;
            $propertieComfortable->comfortable_id = $data["comfortable"];
            $propertieComfortable->quantity = $data["quantityComfortable"];

            if (!$propertieComfortable->save()) {
                $json["message"] = $propertieComfortable->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Cômodo Inserido com sucesso")->flash();
            echo json_encode(["redirect" => url("/admin/properties/properties/{$propertie->reference}/details/comfortable")]);
            return;
            // var_dump($propertieComfortable);
        }


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
            "comfortable" => $comfortable,
            "propertie" => $propertie,
            "propertieComfortable" => $propertieComfortable,
            // "countComfortable" => $countComfortable,
            // "propertieFeatures"  => $propertieFeatures,
            // "countFeatures" => $countFeatures,
            // "propertieStructures"  => $propertieStructures
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
