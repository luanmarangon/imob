<?php

namespace Source\Models;

use Source\Core\Model;

class OwnersContacts extends Model
{
    public function __construct()
    {
        parent::__construct("owners_contacts", [], ["owners_id", "contacts_id"]);
    }
}