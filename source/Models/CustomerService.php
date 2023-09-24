<?php

namespace Source\Models;

use Source\Core\Model;

class CustomerService extends Model
{
    public function __construct()
    {
        parent::__construct("customer_service", ["id"], ["name", "email", "phone", "messageContact", "status"]);
    }
}
