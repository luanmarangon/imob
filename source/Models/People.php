<?php

namespace Source\Models;

use Source\Core\Model;

class People extends Model
{
    public function __construct()
    {
        parent::__construct("people", ["id"], ["first_name", "last_name", "genre", "birth", "cpf", "rg"]);
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // public function addressPeople(): ?Addresses
    // {
    //     if ($this->people_id) {
    //         return (new Addresses())->findById($this->addresses_id);
    //     }
    //     return null;
    // }

    public function addressPeople(int $peopleId): ?Addresses
    {
        if ($peopleId) {
            return (new Addresses())->findByPeople($peopleId);
        }
        return null;
    }

    public function contactPeople(int $peopleId): ?PeopleContacts
    {
        if ($peopleId) {
            return (new PeopleContacts())->findByContacts($peopleId);
        }
        return null;
    }
}