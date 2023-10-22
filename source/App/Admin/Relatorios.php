<?php

namespace Source\App\Admin;

use Source\Models\Auth;
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
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $categoryCreate = new Category();
            $categoryCreate->category = $data["category"];
            $categoryCreate->status = 'Ativo';

            if (!$categoryCreate->save()) {
                $json["message"] = $categoryCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Categoria cadastrado com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/settings/category")]);

            return;
        }

        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
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

    public function categoryUpdate(?array $data): void
    {
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $categoryUpdate = (new Category())->findById($data["category_id"]);

            /**
             * Condição para travar um User->Level menor de alterar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Desculpe, você não possui permissão para editar. Por favor, entre em contato com o administrador para obter assistência!")->flash();
                echo json_encode(["redirect" => url("admin/settings/category")]);
                return;
            }

            if (!$categoryUpdate) {
                $this->message->error("Você tentou gerenciar um característica que não existe ou foi removido")->flash();
                echo json_encode(["redirect" => url("admin/settings/category")]);
                return;
            }

            $categoryUpdate->category = $data["category"];



            if (!$categoryUpdate->save()) {
                $json["message"] = $categoryUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Categoria atualizada com sucesso...")->flash();
            echo json_encode(["redirect" => url("admin/settings/category")]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $categoryDelete = (new Category())->findById($data["category_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!")->flash();
                echo json_encode(["redirect" => url("admin/settings/category")]);
                return;
            }

            if (!$categoryDelete) {
                $this->message->error("Você tentou Inativar uma categoria que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/category")]);
                return;
            }

            $categoryDelete->status = 'Inativo';
            $categoryDelete->save();

            $this->message->success("Categoria inativada com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/category")]);
            return;
        }

        //ativar
        if (!empty($data["action"]) && $data["action"] == "ativar") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $categoryActivate = (new Category())->findById($data["category_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!.")->flash();
                echo json_encode(["redirect" => url("admin/settings/category")]);
                return;
            }

            if (!$categoryActivate) {
                $this->message->error("Você tentou Ativar um usuário que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/category")]);
                return;
            }
            $categoryActivate->status = 'Ativo';
            $categoryActivate->save();

            $this->message->success("Categoria Ativado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/category")]);
            return;
        }

        $categoryEdit = null;
        if (!empty($data["category_id"])) {
            $categoryId = filter_var($data["category_id"], FILTER_SANITIZE_STRIPPED);
            $categoryEdit = (new Category())->findById($categoryId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/categoryUpdate", [
            "app" => "settings/category",
            "head" => $head,
            "category" => $categoryEdit

        ]);
    }

    public function charges(?array $data): void
    {

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $chargesCreate = new Charge();
            $chargesCreate->charge = $data["charge"];
            $chargesCreate->status = "Ativo";

            if (!$chargesCreate->save()) {
                $json["message"] = $chargesCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Cobrança cadastrado com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/settings/charges")]);

            return;
        }

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

    public function chargesUpdate(?array $data): void
    {
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $chargesUpdate = (new Charge())->findById($data["charge_id"]);

            /**
             * Condição para travar um User->Level menor de alterar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Desculpe, você não possui permissão para editar. Por favor, entre em contato com o administrador para obter assistência!")->flash();
                echo json_encode(["redirect" => url("admin/settings/charges")]);
                return;
            }

            if (!$chargesUpdate) {
                $this->message->error("Você tentou gerenciar um cômodo que não existe ou foi removido")->flash();
                echo json_encode(["redirect" => url("admin/settings/charges")]);
                return;
            }

            $chargesUpdate->charge = $data["charge"];



            if (!$chargesUpdate->save()) {
                $json["message"] = $chargesUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Cobrança atualizado com sucesso...")->flash();
            echo json_encode(["redirect" => url("admin/settings/charges")]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $chargeDelete = (new Charge())->findById($data["charge_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!")->flash();
                echo json_encode(["redirect" => url("admin/settings/charges")]);
                return;
            }

            if (!$chargeDelete) {
                $this->message->error("Você tentou Inativar uma categoria que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/charges")]);
                return;
            }

            $chargeDelete->status = 'Inativo';
            $chargeDelete->save();

            $this->message->success("Cobrança inativada com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/charges")]);
            return;
        }

        //ativar
        if (!empty($data["action"]) && $data["action"] == "ativar") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $chargeActivate = (new Charge())->findById($data["charge_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!.")->flash();
                echo json_encode(["redirect" => url("admin/settings/charges")]);
                return;
            }

            if (!$chargeActivate) {
                $this->message->error("Você tentou Ativar um usuário que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/charges")]);
                return;
            }
            $chargeActivate->status = 'Ativo';
            $chargeActivate->save();

            $this->message->success("Categoria Ativado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/charges")]);
            return;
        }

        $chargesEdit = null;
        if (!empty($data["charge_id"])) {
            $chargesId = filter_var($data["charge_id"], FILTER_SANITIZE_STRIPPED);
            $chargesEdit = (new Charge())->findById($chargesId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/chargesUpdate", [
            "app" => "settings/charges",
            "head" => $head,
            "charge" => $chargesEdit

        ]);
    }

    public function comfortable(?array $data): void
    {
        // $teste = new Comfortable();
        // $teste->convenient = "TesteLUan";
        // $teste->Save();
        // var_dump($teste);

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $comfortableCreate = new comfortable();
            $comfortableCreate->convenient = $data["convenient"];
            // echo json_encode(["teste" => var_dump($comfortableCreate)]);
            if (!$comfortableCreate->save()) {
                $json["message"] = $comfortableCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Cômodo cadastrado com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/settings/comfortable")]);

            return;
        }


        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/settings/comfortable/{$s}/1")]);
            return;
        }

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

    public function comfortableUpdate(?array $data): void
    {
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $comfortableUpdate = (new Comfortable())->findById($data["comfortable_id"]);

            /**
             * Condição para travar um User->Level menor de alterar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Desculpe, você não possui permissão para editar. Por favor, entre em contato com o administrador para obter assistência!")->flash();
                echo json_encode(["redirect" => url("admin/settings/comfortable")]);
                return;
            }

            if (!$comfortableUpdate) {
                $this->message->error("Você tentou gerenciar um cômodo que não existe ou foi removido")->flash();
                echo json_encode(["redirect" => url("admin/settings/comfortable")]);
                return;
            }

            $comfortableUpdate->convenient = $data["convenient"];



            if (!$comfortableUpdate->save()) {
                $json["message"] = $comfortableUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Cômodo atualizado com sucesso...")->flash();
            echo json_encode(["redirect" => url("admin/settings/comfortable")]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $comfortableDelete = (new Comfortable())->findById($data["comfortable_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!")->flash();
                echo json_encode(["redirect" => url("admin/settings/comfortable")]);
                return;
            }

            if (!$comfortableDelete) {
                $this->message->error("Você tentou Inativar uma cômodo que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/comfortable")]);
                return;
            }

            $comfortableDelete->status = 'Inativo';
            $comfortableDelete->save();

            $this->message->success("Cômodo inativado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/comfortable")]);
            return;
        }

        //ativar
        if (!empty($data["action"]) && $data["action"] == "ativar") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $comfortableActivate = (new Comfortable())->findById($data["comfortable_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!.")->flash();
                echo json_encode(["redirect" => url("admin/settings/comfortable")]);
                return;
            }

            if (!$comfortableActivate) {
                $this->message->error("Você tentou Ativar um cômodo que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/comfortable")]);
                return;
            }

            $comfortableActivate->status = 'Ativo';
            $comfortableActivate->save();

            $this->message->success("Cômodo Ativado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/comfortable")]);
            return;
        }

        $comfortableEdit = null;
        if (!empty($data["comfortable_id"])) {
            $comfortableId = filter_var($data["comfortable_id"], FILTER_SANITIZE_STRIPPED);
            $comfortableEdit = (new Comfortable())->findById($comfortableId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/comfortableUpdate", [
            "app" => "settings/feature",
            "head" => $head,
            "comfortable" => $comfortableEdit

        ]);
    }

    public function feature(?array $data): void
    {

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $featureCreate = new Features();
            $featureCreate->feature = $data["feature"];



            if (!$featureCreate->save()) {
                $json["message"] = $featureCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Característica cadastrado com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/settings/feature")]);
            // echo json_encode(["redirect" => url("/admin/users/user/{$featureCreate->id}")]);

            return;
        }

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

    public function featureUpdate(?array $data): void
    {
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $featureUpdate = (new Features())->findById($data["feature_id"]);

            /**
             * Condição para travar um User->Level menor de alterar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Desculpe, você não possui permissão para editar. Por favor, entre em contato com o administrador para obter assistência!")->flash();
                echo json_encode(["redirect" => url("admin/settings/feature")]);
                return;
            }

            if (!$featureUpdate) {
                $this->message->error("Você tentou gerenciar um característica que não existe ou foi removido")->flash();
                echo json_encode(["redirect" => url("admin/settings/feature")]);
                return;
            }

            $featureUpdate->feature = $data["feature"];



            if (!$featureUpdate->save()) {
                $json["message"] = $featureUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Característica atualizado com sucesso...")->flash();
            echo json_encode(["redirect" => url("admin/settings/feature")]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $featureDelete = (new Features())->findById($data["feature_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!")->flash();
                echo json_encode(["redirect" => url("admin/settings/feature")]);
                return;
            }

            if (!$featureDelete) {
                $this->message->error("Você tentou Inativar uma categoria que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/feature")]);
                return;
            }

            $featureDelete->status = 'Inativo';
            $featureDelete->save();

            $this->message->success("Característica inativada com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/feature")]);
            return;
        }

        //ativar
        if (!empty($data["action"]) && $data["action"] == "ativar") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $featureActivate = (new Features())->findById($data["feature_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!.")->flash();
                echo json_encode(["redirect" => url("admin/settings/feature")]);
                return;
            }

            if (!$featureActivate) {
                $this->message->error("Você tentou Ativar um usuário que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/feature")]);
                return;
            }

            $featureActivate->status = 'Ativo';
            $featureActivate->save();

            $this->message->success("Característica Ativada com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/feature")]);
            return;
        }

        $featureEdit = null;
        if (!empty($data["feature_id"])) {
            $featureId = filter_var($data["feature_id"], FILTER_SANITIZE_STRIPPED);
            $featureEdit = (new Features())->findById($featureId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/featureUpdate", [
            "app" => "settings/feature",
            "head" => $head,
            "feature" => $featureEdit

        ]);
    }

    public function structures(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $strucutureCreate = new Structures();
            $strucutureCreate->structure = $data["structure"];

            if (!$strucutureCreate->save()) {
                $json["message"] = $strucutureCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Estrutura cadastrado com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/settings/structures")]);

            return;
        }

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

    public function structuresUpdate(?array $data): void
    {
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $structureUpdate = (new Structures())->findById($data["structure_id"]);

            /**
             * Condição para travar um User->Level menor de alterar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Desculpe, você não possui permissão para editar. Por favor, entre em contato com o administrador para obter assistência!")->flash();
                echo json_encode(["redirect" => url("admin/settings/structures")]);
                return;
            }

            if (!$structureUpdate) {
                $this->message->error("Você tentou gerenciar uma estrutura que não existe ou foi removido")->flash();
                echo json_encode(["redirect" => url("admin/settings/structures")]);
                return;
            }

            $structureUpdate->structure = $data["structure"];

            if (!$structureUpdate->save()) {
                $json["message"] = $structureUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Estrutura atualizado com sucesso...")->flash();
            echo json_encode(["redirect" => url("admin/settings/structures")]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $structuresDelete = (new Structures())->findById($data["structure_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!")->flash();
                echo json_encode(["redirect" => url("admin/settings/structures")]);
                return;
            }

            if (!$structuresDelete) {
                $this->message->error("Você tentou Inativar uma cômodo que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/structures")]);
                return;
            }

            $structuresDelete->status = 'Inativo';
            $structuresDelete->save();

            $this->message->success("Estrutura inativada com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/structures")]);
            return;
        }

        //ativar
        if (!empty($data["action"]) && $data["action"] == "ativar") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $structuresActivate = (new Structures())->findById($data["structure_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!.")->flash();
                echo json_encode(["redirect" => url("admin/settings/structures")]);
                return;
            }

            if (!$structuresActivate) {
                $this->message->error("Você tentou Ativar um cômodo que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/comfortable")]);
                return;
            }

            $structuresActivate->status = 'Ativo';
            $structuresActivate->save();

            $this->message->success("Estrutura Ativada com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/structures")]);
            return;
        }

        $structureEdit = null;
        if (!empty($data["structure_id"])) {
            $structureId = filter_var($data["structure_id"], FILTER_SANITIZE_STRIPPED);
            $structureEdit = (new Structures())->findById($structureId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/structuresUpdate", [
            "app" => "settings/structures",
            "head" => $head,
            "structure" => $structureEdit

        ]);
    }

    public function types(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $typeCreate = new Type();
            $typeCreate->type = $data["type"];

            if (!$typeCreate->save()) {
                $json["message"] = $typeCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Tipo cadastrado com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/settings/types")]);

            return;
        }

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

    public function typesUpdate(?array $data): void
    {
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $typeUpdate = (new Type())->findById($data["type_id"]);

            /**
             * Condição para travar um User->Level menor de alterar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Desculpe, você não possui permissão para editar. Por favor, entre em contato com o administrador para obter assistência!")->flash();
                echo json_encode(["redirect" => url("admin/settings/types")]);
                return;
            }

            if (!$typeUpdate) {
                $this->message->error("Você tentou gerenciar um característica que não existe ou foi removido")->flash();
                echo json_encode(["redirect" => url("admin/settings/types")]);
                return;
            }

            $typeUpdate->type = $data["type"];



            if (!$typeUpdate->save()) {
                $json["message"] = $typeUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Característica atualizado com sucesso...")->flash();
            echo json_encode(["redirect" => url("admin/settings/types")]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $typeDelete = (new Type())->findById($data["type_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!")->flash();
                echo json_encode(["redirect" => url("admin/settings/types")]);
                return;
            }

            if (!$typeDelete) {
                $this->message->error("Você tentou Inativar uma cômodo que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/types")]);
                return;
            }

            $typeDelete->status = 'Inativo';
            $typeDelete->save();

            $this->message->success("Tipo de Imóvel inativado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/types")]);
            return;
        }

        //ativar
        if (!empty($data["action"]) && $data["action"] == "ativar") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $typeActivate = (new Type())->findById($data["type_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10) {
                $this->message->error("Você não tem permissão para inativar esse item. Por favor verifique com o Administrador!.")->flash();
                echo json_encode(["redirect" => url("admin/settings/types")]);
                return;
            }

            if (!$typeActivate) {
                $this->message->error("Você tentou Ativar um cômodo que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/settings/types")]);
                return;
            }

            $typeActivate->status = 'Ativo';
            $typeActivate->save();

            $this->message->success("Tipo de Imóvel Ativado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/settings/types")]);
            return;
        }

        $typeEdit = null;
        if (!empty($data["type_id"])) {
            $typeId = filter_var($data["type_id"], FILTER_SANITIZE_STRIPPED);
            $typeEdit = (new Type())->findById($typeId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Configurações",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/settings/typesUpdate", [
            "app" => "settings/types",
            "head" => $head,
            "type" => $typeEdit

        ]);
    }
}