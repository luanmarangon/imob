<?php

namespace Source\Models;

use Source\Core\Model;

class Structures extends Model
{
    public function __construct()
    {
        parent::__construct("structures", ["id"], ["structure"]);
    }
}
