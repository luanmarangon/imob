<?php


namespace Source\App\Admin;

use Source\Models\Report;
use Source\Support\Pager;
use Source\App\Admin\Admin;
use Source\Models\Addresses;
use Source\Models\People;
use Source\Models\Properties;



class Reports extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Relatórios",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/reports/home", [
            "app" => "reports/home",
            "head" => $head,
        ]);
    }


    public function relImoveis(array $data): void
    {
        $citys = (new Addresses())->find("", "", "DISTINCT city, state")->fetch(true);
        $reports = null;
        $dateFirst = null;
        $dateLast = null;

        if (!empty($data["action"]) && $data["action"] == "relImoveis") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            // if (!empty($data['csrf'])) {
            //     if (!csrf_verify($data)) {
            //         $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
            //         echo json_encode($json);
            //         return;
            //     } else {
            if (empty($data['city']) || ($data['city'] == 'Geral')) {
                $city = null;
                $state = null;
            } else {
                $parts = explode("-", $data["city"]);
                $city = $parts[0];
                $state = $parts[1];
            }

            if (empty($data['dateFirst'])) {
                $dateFirst = '2023-01-01';
            } else {
                $dateFirst = $data['dateFirst'];
            }

            if (empty($data['dateLast'])) {
                $dateLast = date('Y-m-d');
            } else {
                $dateLast = $data['dateLast'];
            }
            $status = $data['status'];

            $reports = (new Properties())->reportsProperties($dateFirst, $dateLast, $city, $state,  $status)->fetch(true);

            if (!$reports) {


                $this->message->success("Resposta cadastrada com sucesso, para agendamento de envio...")->flash();
                // echo json_encode(["redirect" => url("/admin/reports/relImoveis")]);

                // $json["message"] = $reports->message()->render();
                // echo json_encode($json);
                // return;

                // $this->message->success("Sem dados...")->flash();
                // echo json_encode(["redirect" => url("/admin/reports/relImoveis")]);
                // echo json_encode(["reload" => true]);
            }
        }


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Relatórios",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/reports/relImoveis", [
            "app" => "reports/relImoveis",
            "head" => $head,
            "citys" => $citys,
            "reports" => $reports,
            "dateFirst" => $dateFirst,
            "dateLast" => $dateLast
            // "paginator" => $pager
        ]);
    }

    /** Incluído em uma unica function */
    // public function relatorioImoveis(array $data): void
    // {
    //     $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
    //     // var_dump($data);

    //     if (empty($data['city']) || ($data['city'] == 'Geral')) {
    //         $city = null;
    //         $state = null;
    //     } else {
    //         $parts = explode("-", $data["city"]);
    //         $city = $parts[0];
    //         $state = $parts[1];
    //     }

    //     if (empty($data['dateFirst'])) {
    //         $dateFirst = '2023-01-01';
    //     } else {
    //         $dateFirst = $data['dateFirst'];
    //     }

    //     if (empty($data['dateLast'])) {
    //         $dateLast = date('Y-m-d');
    //     } else {
    //         $dateLast = $data['dateLast'];
    //     }
    //     $status = $data['status'];


    //     // $dateFirst =  '2022-06-04';
    //     // $dateLast = ' 2023-11-15';

    //     // $status = 'Ativo';
    //     // $city = null;
    //     // $state = null;



    //     $reports = (new Properties())->reportsProperties($dateFirst, $dateLast, $city, $state,  $status);

    //     // var_dump($reports);

    //     // $search = null;
    //     // $all = ($search ?? "all");
    //     // $pager = new Pager(url("/admin/reports/relatorioImoveis/{$all}/"));
    //     // $pager->pager($reports->count(), 18, (!empty($data["page"]) ? $data["page"] : 1));

    //     // $this->message->success("Relatorio cadastrado com sucesso...")->flash();
    //     // echo json_encode(["redirect" => url("/admin/reports/relatorioImoveis")]);
    //     // echo json_encode(["reload" => true]);
    //     // return;

    //     $head = $this->seo->render(
    //         CONF_SITE_NAME . " | Relatórios",
    //         CONF_SITE_DESC,
    //         url("/admin"),
    //         theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
    //         false
    //     );

    //     echo $this->view->render("widgets/reports/relatorioImoveis", [
    //         "app" => "reports/relImoveis",
    //         "head" => $head,
    //         "reports" => $reports->fetch(true),
    //         // "reports" => $reports->limit($pager->limit())->offset($pager->offset())->order("reference ASC")->fetch(true),
    //         // "paginator" => $pager->render()
    //     ]);
    // }

    public function relClients(array $data): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Relatórios",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/reports/relClients", [
            "app" => "reports/relClients",
            "head" => $head,

        ]);
    }



    public function relatorioClientes(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (empty($data['genre'])) {
            $genre = null;
        } else {
            $genre = $data['genre'];
        }

        if (empty($data['dateFirst'])) {
            $dateFirst = '2023-01-01';
        } else {
            $dateFirst = $data['dateFirst'];
        }

        if (empty($data['dateLast'])) {
            $dateLast = date('Y-m-d');
        } else {
            $dateLast = $data['dateLast'];
        }
        // if (empty($data['status'])) {
        //     $status = '0';
        //     // $status = null;
        // }
        $status = $data['status'];

        $reports = (new People())->reportsPeoples($dateFirst, $dateLast, $genre, $status);

        // var_dump($reports);
        // exit();


        // $search = null;
        // $all = ($search ?? "all");
        // $pager = new Pager(url("/admin/reports/relatorioImoveis/{$all}/"));
        // $pager->pager($reports->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Relatórios",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/reports/relatorioClientes", [
            "app" => "reports/relImoveis",
            "head" => $head,
            "reports" => $reports->fetch(true),
            // "reports" => $reports->limit($pager->limit())->offset($pager->offset())->order("reference ASC")->fetch(true),
            // "paginator" => $pager->render()
        ]);
    }
}