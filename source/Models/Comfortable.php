<?php

namespace Source\Models;

use Source\Core\Model;

class Comfortable extends Model
{
    public function __construct()
    {
        parent::__construct("comfortable", ["id"], ["convenient"]);
    }
}
