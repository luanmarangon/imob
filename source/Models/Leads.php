<?php

namespace Source\Models;

use Source\Core\Model;

class Leads extends Model
{
    public function __construct()
    {
        parent::__construct("leads", ["id"], ["full_name", "email", "phone"]);
    }
}
