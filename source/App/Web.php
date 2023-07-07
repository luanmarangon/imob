<?php

namespace Source\App;

use Source\App\Admin\Transaction;
use Source\Models\Auth;
use Source\Models\Images;
use Source\Core\Controller;
use Source\Models\Category;
use Source\Models\Tributes;
use Source\Models\Properties;
use Source\Models\Structures;
use Source\Models\Comfortable;
use Source\Models\CustomerService;
use Source\Models\Interest;
use Source\Models\Leads;
use Source\Models\Transactions;
use Source\Models\PropertiesStructures;
use Source\Models\PropertiesComfortable;
use Source\Models\PropertiesFeatures;
use Source\Models\User;

class Web extends Controller
{
    public function __construct()
    {
        //  COLOCANDO O SISTEMA EM MANUTENÇÃO
        // redirect("/ops/manutencao");
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");

        // $teste = (new PropertiesComfortable())->find("properties_id = :id", "id=3")->fetch(true);
        // $teste2 = (new Comfortable())->find()->fetch(true);

        // foreach ($teste as $test) {
        //     var_dump($test);
        // }
        // var_dump($teste2);

    }


    public function home(): void
    {
        $properties = (new Properties())->find(
            "active = :active",
            "active=1"
        )
            // ->limit(10)
            // ->order("updated_at ASC")
            ->fetch(true);

        /**Validar o order updated_at ASC */


        $sale = (new Transactions())->find(
            "type = :type AND status = :status ",
            "type=Venda&status=Ativo"
        )->fetch(true);

        $rent = (new Transactions())->find(
            "type = :type AND status = :status ",
            "type=Aluguel&status=Ativo"
        )->fetch(true);

        // var_dump($properties);

        $propertiComfortable = (new PropertiesComfortable())->find()->fetch(true);
        $propertiStructures  = (new PropertiesStructures())->find()->fetch(true);

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.png")
        );

        echo $this->view->render("home", [
            "head" => $head,
            "properties" => $properties,
            "propertiComfortable" => $propertiComfortable,
            "propertiStructures" => $propertiStructures,
            "sale" => $sale,
            "rent" => $rent
        ]);
    }

    public function interest(array $data): void
    {
        // var_dump($data);
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $interest = (new Interest());
        $interest->name = $data['name'];
        $interest->email = $data['email'];
        $interest->phone = $data['phone'];
        $interest->message = $data['message'];
        $interest->transactions_id = $data['transaction'];



        // $test = (new Leads())->find(
        //     "full_name = :name or email = :mail or phone = :phone",
        //     "name={$lead->full_name}&mail={$lead->email}&&phone={$lead->phone}"
        // )->fetch();

        // if ($test) {
        //     $this->message->warning("Esse registro já está cadastrado em nosso sistema. Por favor, verifique os dados fornecidos e tente novamente.")->flash();
        //     echo json_encode(["reload" => true]);
        //     return;
        // }

        if (!$interest->save()) {
            // var_dump($interest);

            $json["message"] = $interest->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Seu registro foi enviado com sucesso! Agradecemos por compartilhar as informações necessárias. Faremos o devido processamento e entraremos em contato, caso necessário.")->flash();
        echo json_encode(["reload" => true]);
        return;
    }

    public function optin(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $lead = (new Leads());
        $lead->full_name = $data['name'];
        $lead->email = $data['email'];
        $lead->phone = $data['phone'];
        $lead->status = "Lead";

        $test = (new Leads())->find(
            "full_name = :name or email = :mail or phone = :phone",
            "name={$lead->full_name}&mail={$lead->email}&&phone={$lead->phone}"
        )->fetch();

        if ($test) {
            $this->message->warning("Esse registro já está cadastrado em nosso sistema. Por favor, verifique os dados fornecidos e tente novamente.")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        if (!$lead->save()) {
            $json["message"] = $lead->message()->render();
            echo json_encode($json);
            return;
        }

        $this->message->success("Seu registro foi enviado com sucesso! Agradecemos por compartilhar as informações necessárias. Faremos o devido processamento e entraremos em contato, caso necessário.")->flash();
        echo json_encode(["reload" => true]);
        return;
    }

    public function contact(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        if ($data) {
            $contact = (new CustomerService());
            $contact->name = $data["name"];
            $contact->email = $data["email"];
            $contact->phone = $data["phone"];
            $contact->message = $data["message"];
            $contact->status = "N";

            if (!$contact->save()) {
                $json["message"] = $contact->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Contato enviado com sucesso...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

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

    public function filter(array $data)
    {
        // var_dump($data);
        if (empty($data)) {
            redirect("/error");
        }
        if ($data['type'] != 'Aluguel' && $data['type'] != 'Venda') {
            redirect("/error");
        } else {
            if ($data['type'] == 'Aluguel') {
                $type = "Alugar";
            } else {
                $type = "Comprar";
            }
        }

        // $transactionType = (new Transactions())->find(
        //     "type = :type AND year(end) < year(now()) AND month(end) < month(now()) and day(end) < day(now())",
        //     "type={$data['type']}"
        // )->fetch();

        $transactionType = (new Transactions())->find(
            "type = :type AND status = :status",
            "type={$data['type']}&status=Ativo"
        )->fetch(true);

        // var_dump($transactionType);

        $properties = (new Properties())->find(
            "active = :active",
            "active=1"
        )
            ->limit(8)
            // ->order("updated_at ASC")
            ->fetch(true);

        $propertiComfortable = (new PropertiesComfortable())->find()->fetch(true);
        $propertiStructures  = (new PropertiesStructures())->find()->fetch(true);

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url("/filtro"),
            theme("/assets/images/share.png")
        );

        echo $this->view->render("filter", [
            "head" => $head,
            "transactionType" => $transactionType,
            "properties" => $properties,
            "propertiComfortable" => $propertiComfortable,
            "propertiStructures" => $propertiStructures,
            "type" => $type,
            "data" => $data['type']
        ]);
    }

    public function emphasis()
    {

        $properties = (new Properties())->find(
            "active = :active",
            "active=1"
        )
            ->limit(8)
            ->order("updated_at ASC")
            ->fetch(true);

        $propertiComfortable = (new PropertiesComfortable())->find()->fetch(true);
        $propertiStructures  = (new PropertiesStructures())->find()->fetch(true);

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url("/propriedades"),
            theme("/assets/images/share.png")
        );

        echo $this->view->render("emphasis", [
            "head" => $head,
            "properties" => $properties,
            "propertiComfortable" => $propertiComfortable,
            "propertiStructures" => $propertiStructures,
        ]);
    }
    public function property(array $data)
    {

        $properti = (new Properties())->findById($data['id']);
        if (!$properti) {
            redirect("/404");
        }

        $propertiesImages = (new Images())->find(
            "properties_id = :properties",
            "properties={$properti->id}"
        )
            ->limit(8)
            ->order("identification ASC")
            ->fetch(true);

        $propertiComfortable = (new PropertiesComfortable())
            ->find()
            ->join("comfortable", "comfortable.id = properties_comfortable.comfortable_id", "properties_id = {$properti->id}")
            ->order("comfortable.convenient ASC")
            ->fetch(true);

        $propertiFeatures = (new PropertiesFeatures())
            ->find()
            ->join("features", "features.id = properties_features.features_id", "properties_id = {$properti->id}")
            ->order("features.feature ASC")
            ->fetch(true);

        $propertiStructures  = (new PropertiesStructures())
            ->find()
            ->join("structures", "structures.id = properties_structures.structures_id", "properties_id = {$properti->id}")
            ->order("structures.structure ASC")
            ->fetch(true);

        $propertiTributes = (new Tributes())->find(
            "properties_id = :properties AND exercise = year(NOW())",
            "properties={$properti->id}"
        )->fetch(true);

        /**Inicio Testes */
        // var_dump($propertiStructures);

        /**Fim Testes */

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url("/propriedades"),
            theme("/assets/images/share.png")
        );

        echo $this->view->render("property", [
            "head" => $head,
            "properti" => $properti,
            "propertiesImages" => $propertiesImages,
            "propertiComfortable" => $propertiComfortable,
            "propertiFeatures" => $propertiFeatures,
            "propertiStructures" => $propertiStructures,
            "propertiTributes" => $propertiTributes

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

    // public function login(array $data)
    // {

    //     if (Auth::user()) {
    //         redirect("/admin");
    //     }

    //     if (!empty($data['csrf'])) {
    //         if (!csrf_verify($data)) {
    //             $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
    //             echo json_encode($json);
    //             return;
    //         }

    //         // if (request_limit("weblogin", 3, 60 * 5)) {
    //         //     $json['message'] = $this->message->error("Você já efetuou 3 tentativas, esse é o Limite. Por favor aguarde 5 segundos para nova tentativa de acesso!")->render();
    //         //     echo json_encode($json);
    //         //     return;
    //         // }

    //         if (empty($data['email'] || empty($data['password']))) {
    //             $json['message'] = $this->message->warning("Informe seu email e senha para entrar")->render();
    //             echo json_encode($json);
    //             return;
    //         }
    //         $save = (!empty($data['save']) ? true : false);
    //         $auth = new Auth();
    //         $login = $auth->login($data['email'], $data['password'], $save);

    //         if ($login) {
    //             $this->message->success("Seja bem-vindo(a) de volta " . Auth::user()->first_name . " " . Auth::user()->last_name . "!")->flash();
    //             $json['redirect'] =  redirect("/admin");
    //         } else {
    //             $json['message'] = $auth->message()->before("Ooops! ")->after("!")->render();
    //         }

    //         echo json_encode($json);
    //         return;
    //     }

    //     $head = $this->seo->render(
    //         "Entrar - " . CONF_SITE_NAME,
    //         CONF_SITE_DESC,
    //         url("/entrar"),
    //         theme("/assets/images/share.jpg")
    //     );

    //     echo $this->view->render("login", [
    //         "head" => $head,
    //         "cookie" => filter_input(INPUT_COOKIE, "authEmail")
    //     ]);


    //     // if (Auth::user()) {
    //     //     redirect("/app");
    //     // }

    //     // if (!empty($data['csrf'])) {
    //     //     if (!csrf_verify($data)) {
    //     //         $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
    //     //         echo json_encode($json);
    //     //         return;
    //     //     }

    //     //     // if (request_limit("weblogin", 3, 60 * 5)) {
    //     //     //     $json['message'] = $this->message->error("Você já efetuou 3 tentativas, esse é o Limite. Por favor aguarde 5 segundos para nova tentativa de acesso!")->render();
    //     //     //     echo json_encode($json);
    //     //     //     return;
    //     //     // }

    //     //     if (empty($data['email'] || empty($data['password']))) {
    //     //         $json['message'] = $this->message->warning("Informe seu email e senha para entrar")->render();
    //     //         echo json_encode($json);
    //     //         return;
    //     //     }
    //     //     $save = (!empty($data['save']) ? true : false);
    //     //     $auth = new Auth();
    //     //     $login = $auth->login($data['email'], $data['password'], $save);
    //     //     // var_dump($save, $auth, $login);

    //     //     if ($login) {
    //     //         $this->message->success("Seja bem-vindo(a) de volta " . Auth::user()->first_name . " " . Auth::user()->last_name . "!")->flash();
    //     //         $json['redirect'] = url("/app");
    //     //     } else {
    //     //         $json['message'] = $auth->message()->before("Ooops! ")->after("")->render();
    //     //     }

    //     //     echo json_encode($json);
    //     //     return;
    //     // }

    //     // $head = $this->seo->render(
    //     //     "Entrar - " . CONF_SITE_NAME,
    //     //     CONF_SITE_DESC,
    //     //     url("/entrar"),
    //     //     theme("/assets/images/share.jpg")
    //     // );

    //     // echo $this->view->render("login", [
    //     //     "head" => $head,
    //     //     "cookie" => filter_input(INPUT_COOKIE, "authEmail")
    //     // ]);
    // }





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
