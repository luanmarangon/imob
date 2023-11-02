<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\Charge;

class Tributes extends Model
{
    public function __construct()
    {
        parent::__construct("tributes", [], ["properties_id", "charges_id", "exercise", "value"]);
    }

    public function findTribute(): ?Charge
    {
        return (new Charge())->findById($this->charges_id);
    }
}
