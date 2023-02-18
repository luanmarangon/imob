<?php

namespace Source\Models;

use Source\Core\Model;

class Features extends Model
{
    public function __construct()
    {
        parent::__construct("features", ["id"], ["feature"]);
    }
}
