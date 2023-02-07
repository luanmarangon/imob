<?php

namespace Source\App;

use Source\Core\Controller;

class Web extends Controller
{
    public function __construct()
    {
        //  COLOCANDO O SISTEMA EM MANUTENÇÃO
        //    redirect("/ops/manutencao");
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");
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
