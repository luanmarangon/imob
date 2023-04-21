<?php

namespace Source\Models;

use Source\Core\Model;

class PropertiesFeatures extends Model
{
    public function __construct()
    {
        parent::__construct("properties_features", ["properties_id", "features_id"], [""]);
    }

    // public function findByProperties(int $id, string $columns = "*"): ?Model
    // {
    //     $find = $this->find("properties_id = :id", "id={$id}", $columns);
    //     return $find;
    // }
    public function features(): ?Features
    {
        return (new Features())->findById($this->features_id);
    }
}
