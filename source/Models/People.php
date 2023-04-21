<?php

namespace Source\Models;

use Source\Core\Model;

class People extends Model
{
    public function __construct()
    {
        parent::__construct("people", ["id"], ["first_name", "last_name", "cpf", "rg"]);
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}