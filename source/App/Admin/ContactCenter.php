<?php

namespace Source\App\Admin;

use Source\Models\Auth;
use Source\Support\Pager;
use Source\Models\CustomerService;
use Source\Models\ResponseService;
use Source\Support\Email;

class ContactCenter extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }


    public function cs()
    {
        redirect("/admin/cs/home");
    }

    public function home()
    {
        // $teste = (new Email())->bootstrap("Teste", "Texto", "luan.limarangon@hotmail.com", "Marangon")->send();
        // var_dump($teste);

        $unreadContactCount = (new CustomerService)->find(
            "status = :status",
            "status=n"
        )->count();

        $thirtyDaysAgo = date('Y-m-d H:i:s', strtotime('-30 days'));

        $unreadContact = (new CustomerService())->find(
            "status = :status AND created_at > :date",
            "status=n&date={$thirtyDaysAgo}"
        )->count();

        $readContactCount = (new CustomerService)->find(
            "status = :status",
            "status=s"
        )->count();

        $readContact = (new CustomerService())->find(
            "status = :status AND created_at > :date",
            "status=s&date={$thirtyDaysAgo}"
        )->count();

        $contact = (new CustomerService())->find(
            "status = :status",
            "status=n"
        )->order("created_at DESC")->limit(3)->fetch(true);


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Central de Contatos",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/cs/home", [
            "app" => "cs/home",
            "head" => $head,
            "unreadContactCount" => $unreadContactCount,
            "unreadContact" => $unreadContact,
            "readContactCount" => $readContactCount,
            "readContact" => $readContact,
            "contact" => $contact


        ]);
    }

    public function contact(?array $data): void
    {
        // $contact = (new CustomerService())->find()->order("created_at DESC")->fetch(true);
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/cs/contato/{$s}/1")]);
            // redirect("/admin/users/home/{$s}/1");
            // echo json_encode($json);
            return;
        }

        $search = null;
        $contact = (new CustomerService())->find();
        // $contact = (new User())->find("level <= {$user->level}");
        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $contact = (new CustomerService())->find("MATCH(name, phone, email) AGAINST(:s)", "s={$search}");
            if (!$contact->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/cs/contato");
            }
        }
        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/cs/contato/{$all}/"));
        $pager->pager($contact->count(), 4, (!empty($data["page"]) ? $data["page"] : 1));

        // var_dump($contact);

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Central de Contatos",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/cs/contact", [
            "app" => "cs/contact",
            "head" => $head,
            "search" => $search,
            "contact" => $contact->limit($pager->limit())->offset($pager->offset())->order("status", "created_at DESC")->fetch(true),
            "paginator" => $pager->render()



        ]);
    }

    public function response(array $data): void
    {
        // var_dump($data);
        $contact = (new CustomerService())->findById($data['id']);
        $whats = preg_replace('/[^0-9]/', '', $contact->phone);
        $response = (new ResponseService())->find(
            "customer_service_id = :cs",
            "cs={$contact->id}"
        )->fetch();

        //create
        if (!empty($data["action"]) && $data["action"] == "responseContact") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $user = Auth::user();
            $contact = (new CustomerService())->findById($data['id']);
            $response = new ResponseService();

            $response->users_id = $user->id;
            $response->customer_service_id = $contact->id;
            $response->response = $data['response'];

            if (!$response->save()) {
                $json["message"] = $response->message()->render();
                echo json_encode($json);
                return;
            }

            $contact->status = 'S';
            $contact->save();

            $subject = "[RETORNO - CONTATO " . CONF_SITE_NAME . "]";
            $body = "
                    <html>
                    <head>
                        <style>
                            /* Estilos de formatação do e-mail */
                            body {
                                font-family: Arial, sans-serif;
                            }
                            .container {
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                border: 1px solid #ccc;
                                border-radius: 5px;
                                background-color: #f9f9f9;
                            }
                            h2 {
                                color: #333;
                            }
                            p {
                                margin-bottom: 15px;
                            }
                            span {
                                font-weight: bold;
                                font-style: italic;
                            }            
                            a:link, a:visited {
                                text-decoration: none
                                }
                            a:hover {
                                text-decoration: underline;
                                }
                            a:active {
                                text-decoration: none
                                }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <h2>Resposta ao Contato</h2>
                            <p>Olá, tudo bem?</p>
                            <p>Estamos retornando sobre o envio do contato através de <a href='" . CONF_SITE_DOMAIN_LINK . "'>" . CONF_SITE_DOMAIN . "</a>.</p>

                            <h3>Aqui está a sua mensagem original:</h3>
                            <blockquote>$contact->messageContact</blockquote>
                            <h3>Nossa Resposta:</h3>
                            <blockquote>$response->response</blockquote>
                            <br>
                            <br>
                            <p>Atenciosamente Equipe " . CONF_SITE_NAME . "</p>
                        </div>
                    </body>
                    </html>
                ";


            $mail = (new Email())->bootstrap($subject, $body, $contact->email, $contact->name)->queue();

            // Aguarde 30 segundos (30.000 milissegundos)
            // usleep(30000);

            $this->message->success("Resposta cadastrada com sucesso, para agendamento de envio...")->flash();
            echo json_encode(["redirect" => url("/admin/cs/contato")]);
            return;
        }


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Central de Contatos",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/cs/response", [
            "app" => "cs/response",
            "head" => $head,
            "contact" => $contact,
            "whats" => $whats,
            "response" => $response


        ]);
    }
}
