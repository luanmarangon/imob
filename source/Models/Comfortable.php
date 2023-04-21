<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\PropertiesComfortable;



class Comfortable extends Model
{
    public function __construct()
    {
        parent::__construct("comfortable", ["id"], ["convinient"]);
    }
}