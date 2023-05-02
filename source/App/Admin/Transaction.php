<?php

namespace Source\App\Admin;

use Source\Models\People;
use Source\Support\Pager;
use Source\App\Admin\Admin;
use Source\Models\Auth;
use Source\Models\Properties;
use Source\Models\Transactions;

class Transaction extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $transactions = (new Transactions())->find()->fetch(true);
        $properties = (new Properties())->find()->fetch(true);
        $rentCount = (new Transactions())->find("type = :type AND end >= NOW()", "type=Aluguel")->count();
        $saleCount = (new Transactions())->find("type = :type AND end >= NOW()", "type=Venda")->count();

        $moneyRent = (new Transactions())->find("type = :type AND end >= NOW()", "type=Aluguel")->order("end ASC ")->limit(1)->fetch();
        $moneySale = (new Transactions())->find("type = :type AND end >= NOW()", "type=Venda")->order("end ASC ")->limit(1)->fetch();
        if (!empty($moneyRent)) {
            $propertieRent = (new Properties())->findById($moneyRent->properties_id);
        } else {
            $propertieRent = 0;
        }

        if (!empty($moneySale)) {
            $propertieSale = (new Properties())->findById($moneySale->properties_id);
        } else {
            $propertieSale = 0;
        }


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/transactions/home", [
            "app" => "transactions/home",
            "head" => $head,
            "properties" => $properties,
            "rentCount" => $rentCount,
            "saleCount" => $saleCount,
            "moneyRent" => $moneyRent,
            "moneySale" => $moneySale,
            "propertieRent" => $propertieRent,
            "propertieSale" => $propertieSale

        ]);
    }

    public function transactions(array $data): void
    {
        $user = Auth::user();
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/transactions/transactions/{$s}/1")]);
            return;
        }

        //read
        $search = null;
        $transactions = (new Transactions())->find();
        $people = (new People())->find()->fetch(true);
        $properties = (new Properties())->find()->fetch(true);

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $transactions = (new Transactions())->find("MATCH(type) AGAINST(:s)", "s={$search}");
            if (!$transactions->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/transactions/transactions");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/transactions/transactions/{$all}/"));
        $pager->pager($transactions->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));

        // var_dump(
        //     // $people,
        //     // $transactions,
        //     // $propertie
        // );


        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóveis",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/transactions/transactions", [
            "app" => "transactions/transactions",
            "head" => $head,
            "transactions" => $transactions->limit($pager->limit())->offset($pager->offset())->order("status, end ASC")->fetch(true),
            "people" => $people,
            "properties" => $properties,
            "search" => $search,
            "paginator" => $pager->render(),
            "user" => $user
            // "moneyRent" => $moneyRent,
            // "moneySale" => $moneySale

        ]);
    }
}