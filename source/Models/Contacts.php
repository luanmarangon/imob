<?php

namespace Source\Models;

use Source\Core\Model;

class Contacts extends Model
{
    public function __construct()
    {
        parent::__construct("contacts", ["id"], ["people_id", "contact", "type"]);
    }


    public function findByContacts(int $id, string $columns = "*"): ?Model
    {
        $find = $this->find("people_id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    public function createContact($type, $value, $personId): bool
    {
        $contact = new Contacts();
        $contact->people_id = $personId;
        $contact->contact = $value;
        $contact->type = $type;
        $contact->status = "Ativo";
        if (!$contact->save()) {
            return false;
        }
        return true;
    }
}
