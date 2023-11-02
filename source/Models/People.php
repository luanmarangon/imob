<?php

namespace Source\Models;

use Source\Core\Model;

class People extends Model
{
    public function __construct()
    {
        parent::__construct("people", ["id"], ["first_name", "last_name", "genre", "datebirth", "cpf", "rg"]);
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }


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
            return (new Contacts())->findByContacts($peopleId);
        }
        return null;
    }

    public function reportsPeoples($dateFirst, $dateLast, $genre = null, $status = null)
    {
        $this->query = "SELECT * FROM people p 
                  JOIN contacts c ON c.people_id = p.id  
                  WHERE (p.created_at > '{$dateFirst}' AND p.created_at < '{$dateLast}')";

        if (!empty($genre)) {
            $this->query .= " AND p.genre = '{$genre}'";
        }

        if (!empty($status) && $status != 'Geral') {
            $this->query .= " AND p.status = '{$status}'";
        }

        return $this;
    }
}
