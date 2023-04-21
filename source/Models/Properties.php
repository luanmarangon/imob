<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\Type;
use Source\Models\Images;
use Source\Models\Category;
use Source\Models\Addresses;
use Source\Models\Transactions;
use Source\Models\PropertiesComfortable;



class Properties extends Model
{
    public function __construct()
    {
        parent::__construct("properties", ["id"], ["addresses_id", "categories_id", "types_id", "description", "reference", "active"]);
    }

    public function category(): ?Category
    {
        if ($this->categories_id) {
            return (new Category())->findById($this->categories_id);
        }
        return null;
    }

    public function type(): ?Type
    {
        if ($this->types_id) {
            return (new Type())->findById($this->types_id);
        }
        return null;
    }

    public function address(): ?Addresses
    {
        if ($this->addresses_id) {
            return (new Addresses())->findById($this->addresses_id);
        }
        return null;
    }

    public function imagesProperties(int $propertiId): ?Images
    {
        if ($propertiId) {
            return (new Images())->findByImage($propertiId);
        }
        return null;
    }

    public function transactionsProperties(int $propertiId): ?Transactions
    {
        if ($propertiId) {
            return (new Transactions())->findTransactionsProperti($propertiId)->fetch();
        }
        return null;
    }


    public function findPropertiesTransactions(int $id, string $columns = "*"): ?Model
    {
        $find = $this->find("properties_id = :id", "id={$id}", $columns);
        return $find;
    }


    //aqui!!!!

    public function comfortableProperties(int $propertiId): ?PropertiesComfortable
    {
        if ($propertiId) {
            return (new PropertiesComfortable())->findByProperties($propertiId);
        }
        return null;
    }

    // public function comfortable(int $propertiId): ?Comfortable
    // {
    //     if ($propertiId) {
    //         return (new Comfortable())->findById($propertiId);
    //     }
    //     return null;
    // }
    public function comfortable(): ?Comfortable
    {

        return (new Comfortable())->find();
    }
}