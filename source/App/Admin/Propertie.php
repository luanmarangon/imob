<?php

namespace Source\App\Admin;

use Source\Support\Pager;
use Source\App\Admin\Admin;
use Source\Models\People;
use Source\Models\Properties;
use Source\Models\PropertiesComfortable;
use Source\Models\PropertiesFeatures;
use Source\Models\PropertiesStructures;
use Source\Models\Structures;
use Source\Models\Transactions;

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