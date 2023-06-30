<?php

namespace Source\Models;

use Source\Core\Model;

class Interest extends Model
{

    public function __construct()
    {
        parent::__construct("interest", ["id"], ["transactions_id", "name", "email", "phone"]);
    }
}