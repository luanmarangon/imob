<?php

namespace Source\Models;

use Source\Core\Model;

class Charge extends Model
{
    public function __construct()
    {
        parent::__construct("charges", ["id"], ["charge"]);
    }
}
