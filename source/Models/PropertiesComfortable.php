<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Core\Connect;
use Source\Models\Comfortable;

class PropertiesComfortable extends Model
{
    public function __construct()
    {
        parent::__construct("properties_comfortable", ["properties_id", "comfortable_id"], ["quantity"]);
    }

    // public function findByProperties(int $id, string $columns = "*"): ?Model
    // {
    //     $find = $this->find("properties_id = :id", "id={$id}", $columns);
    //     return $find;
    // }

    public function comfortable(): ?Comfortable
    {
        return (new Comfortable())->findById($this->comfortable_id);
    }


























    // public function comfortableProperties(int $comfortableId): ?PropertiesComfortable
    // {
    //     if ($comfortableId) {
    //         return (new PropertiesComfortable())->findByComfortable($comfortableId);
    //     }
    //     return null;
    // }




    // public function findTransactionsProperti(int $id, string $columns = "*"): ?Model
    // {
    //     $find = $this->find("properties_id = :id", "id={$id}", $columns);
    //     return $find->fetch();
    // }

    // public function teste(int $id, string $columns = "*"): ?Model
    // {
    //     $find = $this->find("properties_id = :id", "id={$id}", $columns);
    //     return $find->fetch();
    // }
}
