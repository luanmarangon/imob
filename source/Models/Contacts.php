<?php

namespace Source\Models;

use Source\Core\Model;

class Contacts extends Model
{
    public function __construct()
    {
        parent::__construct("contacts", ["id"], ["contact", "type"]);
    }

    public function createContact($type, $value, $personId): bool
    {
        $contact = new Contacts();
        $contact->contact = $value;
        $contact->type = $type;
        if ($contact->save()) {
            $peopleContacts = new PeopleContacts();
            $peopleContacts->people_id = $personId;
            $peopleContacts->contacts_id = $contact->id;
            if ($peopleContacts->save()) {
                return true;
            } else {
                // log error
                error_log('Failed to create people contacts.');
            }
        } else {
            // log error
            error_log('Failed to create contacts.');
        }
        return false;
    }

    // public function findContactPeople(int $id, string $columns = "*"): ?Model
    // {
    //     $find = $this->find("properties_id = :id", "id={$id}", $columns);
    //     return $find;
    // }
}