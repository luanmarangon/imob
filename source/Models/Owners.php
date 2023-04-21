<?php

namespace Source\Models;

use Source\Core\Model;

class Owners extends Model
{
    public function __construct()
    {
        parent::__construct("owners", ["id"], ["first_name", "last_name", "cpf", "rg"]);
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

}