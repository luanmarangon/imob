<?php

namespace Source\App\Admin;

use Source\Models\Type;
use Source\Models\Charge;
use Source\Support\Pager;
use Source\App\Admin\Admin;
use Source\Models\Category;
use Source\Models\Features;
use Source\Models\Structures;
use Source\Models\Comfortable;

class Setting extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {

        $category = (new Category())->find()->count();
        $charge = (new Charge())->find()->count();
        $comfortable = (new Comfortable())->find()->count();
        $feature = (new Features())->find()->count();
        $structures = (new Structures())->find()->count();
        $types = (new Type())->find()->count();


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/home", [
            "app" => "settings/home",
            "head" => $head,
            "category" => $category,
            "charge" => $charge,
            "comfortable" => $comfortable,
            "feature" => $feature,
            "structures" => $structures,
            "types" => $types
        ]);
    }

    public function category(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            // redirect("/admin/settings/category/{$s}/1");
            echo json_encode(["redirect" => url("/admin/settings/category/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $categories = (new Category())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $categories = (new Category())->find("MATCH(category) AGAINST(:s)", "s={$search}");
            if (!$categories->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/settings/category");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/settings/category/{$all}/"));
        $pager->pager($categories->count(), 9, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/category", [
            "app" => "settings/category",
            "head" => $head,
            "categories" => $categories->limit($pager->limit())->offset($pager->offset())->order("category")->fetch(true),
            "search" => $search,
            "paginator" => $pager->render(),
        ]);
    }

    public function charges(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/settings/charges/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $charges = (new Charge())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $charges = (new Charge())->find("MATCH(charge) AGAINST(:s)", "s={$search}");
            if (!$charges->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/settings/charges");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/settings/charges/{$all}/"));
        $pager->pager($charges->count(), 9, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/charges", [
            "app" => "settings/charges",
            "head" => $head,
            "charges" => $charges->limit($pager->limit())->offset($pager->offset())->order("charge")->fetch(true),
            "search" => $search,
            "paginator" => $pager->render(),

        ]);
    }

    public function comfortable(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/settings/comfortable/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $comfortable = (new Comfortable())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $comfortable = (new Comfortable())->find("MATCH(convenient) AGAINST(:s)", "s={$search}");
            if (!$comfortable->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/settings/comfortable");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/settings/comfortable/{$all}/"));
        $pager->pager($comfortable->count(), 9, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/comfortable", [
            "app" => "settings/comfortable",
            "head" => $head,
            "comfortable" => $comfortable->limit($pager->limit())->offset($pager->offset())->order("convenient")->fetch(true),
            "search" => $search,
            "paginator" => $pager->render(),
        ]);
    }

    public function feature(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/settings/feature/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $features = (new Features())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $features = (new Features())->find("MATCH(feature) AGAINST(:s)", "s={$search}");
            if (!$features->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/settings/feature");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/settings/feature/{$all}/"));
        $pager->pager($features->count(), 9, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/feature", [
            "app" => "settings/feature",
            "head" => $head,
            "features" => $features->limit($pager->limit())->offset($pager->offset())->order("feature")->fetch(true),
            "search" => $search,
            "paginator" => $pager->render(),
        ]);
    }

    public function structures(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/settings/structures/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $structures = (new Structures())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $structures = (new Structures())->find("MATCH(structure) AGAINST(:s)", "s={$search}");
            if (!$structures->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/settings/structures");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/settings/structures/{$all}/"));
        $pager->pager($structures->count(), 9, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/structures", [
            "app" => "settings/structures",
            "head" => $head,
            "structures" => $structures->limit($pager->limit())->offset($pager->offset())->order("structure")->fetch(true),
            "search" => $search,
            "paginator" => $pager->render(),
        ]);
    }

    public function types(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/settings/types/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $types = (new Type())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $types = (new Type())->find("MATCH(type) AGAINST(:s)", "s={$search}");
            if (!$types->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/settings/types");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/settings/types/{$all}/"));
        $pager->pager($types->count(), 9, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/types", [
            "app" => "settings/types",
            "head" => $head,
            "types" => $types->limit($pager->limit())->offset($pager->offset())->order("type")->fetch(true),
            "search" => $search,
            "paginator" => $pager->render(),
        ]);
    }
}
