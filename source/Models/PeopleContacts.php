<?php

namespace Source\Models;

use Source\Core\Model;

class PeopleContacts extends Model
{
    public function __construct()
    {
        parent::__construct("people_contacts", [], ["people_id", "contacts_id"]);
    }

    public function findByOwners(int $id, string $columns = "*"): ?Model
    {
        $find = $this->find("people_id = :id", "id={$id}", $columns);
        return $find;
    }

    public function contact(): ?Contacts
    {
        return (new Contacts())->findById($this->contacts_id);
    }
}