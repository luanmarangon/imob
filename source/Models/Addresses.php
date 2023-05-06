<?php

namespace Source\Models;

use Source\Core\Model;

class Addresses extends Model
{
    public function __construct()
    {
        parent::__construct(
            "addresses",
            ["id"],
            [
                "people_id",
                "street",
                "number",
                "complement",
                "district",
                "city",
                "state",
                "zipcode",
                "latitude",
                "longitude"
            ]
        );
    }

    public function findByPeople(int $id, string $columns = "*"): ?Model
    {
        $find = $this->find("people_id = :id", "id={$id}", $columns);
        return $find->fetch();
    }

    //fim
}
