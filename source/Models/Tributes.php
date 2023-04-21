<?php

namespace Source\Models;

use Source\Core\Model;

class Tributes extends Model
{
    public function __construct()
    {
        parent::__construct("tributes", ["properties_id", "charges_id"], ["exercise", "value"]);
    }
}
