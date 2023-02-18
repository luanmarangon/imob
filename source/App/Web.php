<?php

namespace Source\App;

use Source\Models\Type;
use Source\Models\User;
use Source\Core\Controller;
use Source\Models\Category;
use Source\Models\Addresses;
use Source\Models\Customers;
use Source\Models\Properties;
use Source\Models\OwnersContacts;
use Source\Models\PropertiesFeatures;
use Source\Models\PropertiesComfortable;
use Source\Models\Transactions;

class Web extends Controller
{
    public function __construct()
    {
        //  COLOCANDO O SISTEMA EM MANUTENÇÃO
        // redirect("/ops/manutencao");
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");

        // $teste = (new Type())->create();
        // $teste = (new User())->findById(5)->destroy();
        // $teste = (new User())->bootstrap("Jessica Fernanda", "Marangon", "jeg.fernanda@marangon.com.br", "12345678", "Administrador", "CEO")->save();
        // $teste = (new Type())->lastId();
        // $delete = (new Type())->delete("id=:id", "id=7");
        // $teste = (new Addresses())->find()->fetch(true);
        // $teste['count'] = (new Addresses())->find("complement=:complement", "complement=Casa")->count();
        // $teste['count_full']  = (new Addresses())->find()->count();
        // $teste["teste"] = (new OwnersContacts())->find()->fetch();
        // $ad = (new Addresses())->create(["teste", "10", "a", "b", "c"])->save();

        // $teste["Imovel"] = (new Properties())->find()->fetch(true);
        // $teste["Owners"] = (new Customers())->find()->fetch(true);
        // $teste["newContact"] = (new PropertiesComfortable())->findByProperties(3);
        // $teste["user"] = (new User())->findByEmail("marangon@imob.com.br")->teste();
        // $teste["categories"] = (new Category())->find()->fetch(true);
        // $teste["last"] = (new Category())->lastId();
        // $teste["categories"] = (new Customers())->find()->fetch(true);
        // $teste["last"] = (new Customers())->lastId();
        // $teste["categories"] = (new PropertiesFeatures())->find();
        // $teste["last"] = (new PropertiesComfortable())->lastPropertId();
        $teste["transactions"] = (new Transactions())->findTransactionsType("venda");
        $teste["last"] = (new Transactions())->lastId();
        // var_dump(
        //     $teste
        // );

        // for ($i = 0; $i < 30; $i++) {
        //     var_dump($teste["categories"][$i]);
        // }

        for ($i = 0; $i < $teste["last"] - 1; $i++) {
            var_dump(
                $teste["last"],
                $teste["transactions"]
                // $ad
            );
        }

        // exit();
    }


    public function home(): void
    {


        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.png")
        );

        echo $this->view->render("home", [
            "head" => $head
        ]);
    }

    public function contact()
    {

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url("/contato"),
            theme("/assets/images/share.png")
        );

        echo $this->view->render("contact", [
            "head" => $head
        ]);
    }

    public function filter()
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url("/filtro"),
            theme("/assets/images/share.png")
        );

        echo $this->view->render("filter", [
            "head" => $head
        ]);
    }

    public function property()
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url("/propriedades"),
            theme("/assets/images/share.png")
        );

        echo $this->view->render("property", [
            "head" => $head
        ]);
    }
    public function propertyReferece()
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url("/propriedades"),
            theme("/assets/images/share.png")
        );

        echo $this->view->render("property", [
            "head" => $head
        ]);
    }

    public function terms()
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url("/termos"),
            theme("/assets/images/share.png")
        );

        echo $this->view->render("terms", [
            "head" => $head
        ]);
    }





    public function error(array $data): void
    {
        $error = new \stdClass();

        switch ($data['errcode']) {
            case "problemas":
                $error->code = "OPS";
                $error->title = "Estamos enfrentando problemas!";
                $error->message = "Parece que nosso serviço não está disponível no momento. Já estamos vendo isso mas caso precise, envie um e-mail :)";
                $error->linkTitle = "ENVIAR E-MAIL";
                $error->link = "mailto:" . CONF_MAIL_SUPPORT;
                break;

            case "manutencao":
                $error->code = "OPS";
                $error->title = "Desculpe. Estamos em manutenção!";
                $error->message = "Voltamos logo! Por hora estamos trabalhando para melhorar nosso conteúdo para você controlar as suas contas :P";
                $error->linkTitle = null;
                $error->link = null;
                break;

            default:
                $error->code = $data['errcode'];
                $error->title = "Ooops. Conteúdo indisponível :/";
                $error->message = "Sentimos muito, mas o conteúdo que você tentou acessar não existe, está indisponível no momento ou foi removido :/";
                $error->linkTitle = "Continue navegando!";
                $error->link = url_back();
                break;
        }



        $head = $this->seo->render(
            "{$error->code} | {$error->title}",
            $error->message,
            url("/ops/{$error->code}"),
            theme("/assets/images/share.png"),
            false
        );

        echo $this->view->render("404", [
            "head" => $head,
            "error" => $error
        ]);
    }
}