<?php

namespace Source\Models;

use Source\Core\Model;

class Type extends Model
{
    public function __construct()
    {
        parent::__construct("types", ["id"], ["type"]);
    }
}
