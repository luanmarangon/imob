<?php

namespace Source\Models;

use Source\Core\Model;

class Properties extends Model
{
    public function __construct()
    {
        parent::__construct("properties", ["id"], ["addresses_id", "categories_id", "types_id", "reference", "active"]);
    }
}