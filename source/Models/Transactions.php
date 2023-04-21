<?php

namespace Source\Models;

use Source\Core\Model;

class Transactions extends Model
{
    public function __construct()
    {
        parent::__construct("transactions", ["id"], ["properties_id", "type", "start", "end", "value"]);
    }


    // public function findTransactionsType(string $type, string $columns = "*"): ?Model
    // {
    //     $find = $this->find("type = :type", "type={$type}", $columns);
    //     return $find->fetch();
    // }

    public function findTransactionsProperti(int $id, string $columns = "*"): ?Model
    {
        $find = $this->find("properties_id = :id", "id={$id}", $columns);
        return $find;
    }


    public function recurrenceRent()
    {
        $recurrence = 0;
        $rentMoney = $this->find("type = :type", "type=Aluguel")->fetch(true);

        if ($rentMoney) {
            foreach ($rentMoney as $rent) {
                $recurrence += $rent->value;
            }
        }
        return $recurrence;
    }

    public function recurrenceSale()
    {
        $recurrence = 0;
        $saleMoney = $this->find("type = :type", "type=Venda")->fetch(true);
        if ($saleMoney) {
            foreach ($saleMoney as $sale) {
                $recurrence += $sale->value;
            }
        }
        return $recurrence;
    }
}