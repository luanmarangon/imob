<?php


namespace Source\Models;

use Source\Core\Model;

class PropertiesStructures extends Model
{

    public function __construct()
    {
        parent::__construct("properties_structures", [], ["properties_id", "structures_id", "footage"]);
    }

    public function structures(): ?Structures
    {
        return (new Structures())->findById($this->structures_id);
    }
}
