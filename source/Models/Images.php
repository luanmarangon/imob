<?php

namespace Source\Models;

use Source\Core\Model;

class Images extends Model
{
    public function __construct()
    {
        parent::__construct("images", ["id"], ["properties_id", "identification", "path"]);
    }

    public function findByImage(int $id, string $columns = "*"): ?Model
    {
        $find = $this->find("properties_id = :id", "id={$id}", $columns);
        return $find->fetch();
    }
}
