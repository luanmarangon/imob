<?php

namespace Source\Models;

use Source\Core\Model;

class Contacts extends Model
{
    public function __construct()
    {
        parent::__construct("contacts", ["id"], ["contact", "type"]);
    }
}
