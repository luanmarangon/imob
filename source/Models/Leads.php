<?php

namespace Source\Models;

use Source\Core\Model;

class Leads extends Model
{
    public function __construct()
    {
        parent::__construct("leads", ["id"], ["full_name", "email", "phone"]);
    }

    // public function name()
    // {
    //     $name = explode(" ", $this->full_name);
    //     $name = implode(" ", array_slice($name, 0, 2));
    //     return $name;
    // }

    public function name()
    {
        $name_parts = explode(" ", $this->full_name);
        $middle = floor(count($name_parts) / 2);
        $first_name = implode(" ", array_slice($name_parts, 0, $middle));
        $last_name = implode(" ", array_slice($name_parts, $middle));
        return [$first_name, $last_name];
    }
}