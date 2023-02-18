<?php

namespace Source\Models;

use Source\Core\Model;

class Transactions extends Model
{
    public function __construct()
    {
        parent::__construct("transactions", ["id"], ["properties_id", "type", "start", "end", "value"]);
    }


    public function findTransactionsType(string $type, string $columns = "*"): ?Model
    {
        $find = $this->find("type = :type", "type={$type}", $columns);
        return $find->fetch();
    }
}