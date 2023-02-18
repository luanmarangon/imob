<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Core\Connect;

class PropertiesComfortable extends Model
{
    public function __construct()
    {
        parent::__construct("properties_comfortable", ["properties_id", "comfortable_id"], ["quantity"]);
    }

    public function findByProperties(int $id, string $columns = "*"): ?Model
    {
        $find = $this->find("properties_id = :id", "id={$id}", $columns);
        return $find->fetch();
    }
}