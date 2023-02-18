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
                "owners_id",
                "street",
                "number",
                "complement",
                "district",
                "city",
                "state",
                "zipcode"
            ]
        );
    }


    //fim
}
