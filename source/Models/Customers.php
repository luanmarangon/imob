<?php

namespace Source\Models;

use Source\Core\Model;

class Customers extends Model
{
    public function __construct()
    {
        parent::__construct("customers", ["id"], ["full_name", "email", "phone"]);
    }
}
