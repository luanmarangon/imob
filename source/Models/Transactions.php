<?php

namespace Source\Models;

use Source\Core\Model;

class Transactions extends Model
{
    public function __construct()
    {
        parent::__construct("transactions", ["id"], ["properties_id", "type", "start", "end", "value", "status"]);
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

    /**Function para apresentar as transactions e Properties -> analisar os dados consultados, o que estiver igual nas tabelas não irá trazer! */
    // public function findTransactionsProperties(int $propertiId)
    // {
    //     $this->query = "SELECT t.*, p.* FROM transactions t
    //                         JOIN properties p ON t.properties_id = p.id
    //                         WHERE t.properties_id = {$propertiId}";

    //     return $this;
    // }

    /**Verificar */
    // public function findTransactions(int $propertiId)
    // {
    //     $this->query = "SELECT t.*, p.*, a.*, pe.*, t.status as tStatus FROM transactions t
    //           JOIN properties p ON t.properties_id = p.id
    //           JOIN addresses a ON p.addresses_id = a.id
    //           JOIN people pe ON a.people_id = pe.id
    //           WHERE t.properties_id = {$propertiId}";

    //     // $results = $this->$query;

    //     return $this;
    // }
}
