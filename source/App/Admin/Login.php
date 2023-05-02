<?php

namespace Source\App\Admin;

use Source\Models\Auth;
use Source\Core\Controller;
use Source\Models\User;

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../themes/" . CONF_VIEW_ADMIN . "/");
    }

    /**
     * Admin access redirect
     * @return void
     */
    public function root(): void
    {
        $user = Auth::user();

        if ($user && $user->level >= 5) {
            redirect("/admin/dash");
        } else {
            redirect("/admin/login");
        }

        //Testar Validação - Caso o User < 5 achar URL do ADMIN
        // if ($user) {
        //     if ($user->level >= 5) {
        //         redirect("/admin/dash");
        //     } else {
        //         redirect("/app");
        //     }
        // } else {
        //     redirect("/admin/login");
        // }
    }

    /**
     * @param array|null $data
     * @return void
     */
    public function login(?array $data): void
    {
        $user = Auth::user();


        if ($user && $user->level >= 5) {
            redirect("/admin/dash");
        }


        if (!empty($data['csrf'])) {
            // if (!csrf_verify($data)) {
            //     $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
            //     // echo json_encode(["msg" => var_dump($data['csrf'])]);
            //     echo json_encode($json,);
            //     return;
            // }

            if (request_limit("weblogin", 3, 60 * 5)) {
                $json['message'] = $this->message->error("Você já efetuou 3 tentativas, esse é o Limite. Por favor aguarde 5 segundos para nova tentativa de acesso!")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data['email'] || empty($data['password']))) {
                $json['message'] = $this->message->warning("Informe seu email e senha para entrar")->render();
                echo json_encode($json);
                return;
            }
            $save = (!empty($data['save']) ? true : false);
            $auth = new Auth();
            // $login = $auth->login($data["email"], $data["password"], true, 5);
            $login = $auth->login($data['email'], $data['password'], $save);

            if ($login) {
                $this->message->success("Seja bem-vindo(a) de volta " . Auth::user()->first_name . " " . Auth::user()->last_name . "!")->flash();
                $json['redirect'] = url("/admin/dash");
            } else {
                $json['message'] = $auth->message()->before("Ooops! ")->after(".")->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Admin",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/login/login", [
            "head" => $head,
            "cookie" => filter_input(INPUT_COOKIE, "authEmail")

        ]);
    }
}