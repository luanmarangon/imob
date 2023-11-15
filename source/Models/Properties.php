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
        parent::__construct("properties", ["id"], ["addresses_id", "categories_id", "types_id", "reference", "description", "active"]);
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

    /** Analisar se ira usar*/
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

    // Pesquisa entender e melhorar

    // public function searchProperties($category, $typesData, $locationData, $featuresData): self
    // {
    //     $this->query = "SELECT *
    //                     FROM properties p
    //                     LEFT JOIN addresses a ON p.addresses_id = a.id
    //                     LEFT JOIN properties_features pf ON p.id = pf.properties_id
    //                     WHERE p.categories_id = :category
    //                     AND p.types_id = :typesData
    //                     AND a.city LIKE :locationData
    //                     AND pf.features_id = :featuresData";

    //     $this->params = [
    //         'category' => $category,
    //         'typesData' => $typesData,
    //         'locationData' => '%' . $locationData . '%',
    //         'featuresData' => $featuresData
    //     ];

    //     return $this;
    // }

    // Em testes
    // public function searchProperties($category, $typesData, $locationData, $featuresData): self
    // {
    //     $typeIds = implode(',', $typesData); // Convertendo o array em uma string separada por vírgulas
    //     $location = '%' . implode('%', $locationData) . '%'; // Concatenando os valores do array com % para fazer a busca parcial
    //     $featureIds = implode(',', $featuresData); // Convertendo o array em uma string separada por vírgulas

    //     $this->query = "SELECT *
    //                 FROM properties p
    //                 LEFT JOIN addresses a ON p.addresses_id = a.id
    //                 LEFT JOIN properties_features pf ON p.id = pf.properties_id
    //                 WHERE p.categories_id = :category
    //                 AND p.types_id IN ({$typeIds}) -- Utilizando IN para comparar com múltiplos valores
    //                 AND a.city LIKE :locationData
    //                 AND pf.features_id IN ({$featureIds}) -- Utilizando IN para comparar com múltiplos valores";

    //     $this->params = [
    //         'category' => $category,
    //         'locationData' => $location,
    //     ];

    //     return $this;
    // }

    // public function searchProperties($category, $typesData, $locationData, $featuresData): self
    // {
    //     $typeIds = implode(',', $typesData); // Convertendo o array em uma string separada por vírgulas
    //     $locationPatterns = array_map(function ($location) {
    //         return "'%" . $location . "%'";
    //     }, $locationData); // Adicionando % no início e no final de cada valor do array
    //     $locationLike = implode(' OR a.city LIKE ', $locationPatterns); // Criando a string para o operador LIKE
    //     $featureIds = implode(',', $featuresData); // Convertendo o array em uma string separada por vírgulas

    //     $this->query = "SELECT *
    //                 FROM properties p
    //                 LEFT JOIN addresses a ON p.addresses_id = a.id
    //                 LEFT JOIN properties_features pf ON p.id = pf.properties_id
    //                 WHERE p.categories_id = :category
    //                 AND p.types_id IN ({$typeIds})
    //                 AND (a.city LIKE {$locationLike}) -- Utilizando o operador LIKE com OR
    //                 AND pf.features_id IN ({$featureIds})";

    //     $this->params = [
    //         'category' => $category,
    //     ];

    //     return $this;
    // }

    // public function searchProperties($category, $typesData = null, $locationData = null, $featuresData = null): self
    // {

    //     if (!is_array($category)) {
    //         $categoryIds = $category;
    //     } else {

    //         $categoryIds = [];
    //         foreach ($category as $cat) {
    //             $categoryIds[] = $cat->id;
    //         }
    //         $categoryIds = implode(',', $categoryIds);
    //     }
    //     $this->query = "SELECT *
    //                     FROM properties p
    //                     LEFT JOIN addresses a ON p.addresses_id = a.id
    //                     LEFT JOIN properties_features pf ON p.id = pf.properties_id
    //                     WHERE p.categories_id IN ({$categoryIds})";

    //     // $this->params = [
    //     //     'category' => $category,
    //     // ];

    //     if (!empty($typesData)) {
    //         $typeIds = implode(',', $typesData);
    //         $this->query .= " AND p.types_id IN ({$typeIds})";
    //     }

    //     if (!empty($locationData)) {
    //         $locationPatterns = array_map(function ($location) {
    //             return "'%" . $location . "%'";
    //         }, $locationData);
    //         $locationLike = implode(' OR a.city LIKE ', $locationPatterns);
    //         $this->query .= " AND (a.city LIKE {$locationLike})";
    //     }

    //     if (!empty($featuresData)) {
    //         $featureIds = implode(',', $featuresData);
    //         $this->query .= " AND pf.features_id IN ({$featureIds})";
    //     }

    //     return $this;
    // }

    public function searchPropertiesAndTransactions($type = null, $category, $typesData = null, $locationData = null, $featuresData = null): self
    {
        if (!is_array($typesData)) {
            $typesIds = $typesData;
        } else {
            $typesIds = [];
            foreach ($typesData as $ty) {
                $typesIds[] = $ty;
            }
            $typesIds = implode(',', $typesIds);
        }


        if (!is_array($category)) {
            $categoryIds = $category;
        } else {
            $categoryIds = [];
            foreach ($category as $cat) {
                // var_dump($cat);

                $categoryIds[] = $cat;
                // var_dump($categoryIds);
                // exit();
            }
            $categoryIds = implode(',', $categoryIds);
        }

        if (!is_array($locationData)) {
            $cityNames = $locationData;
        } else {
            $cityNames = [];
            foreach ($locationData as $city) {
                $parts = explode("-", $city);
                $cityNames[] = $parts[0];
            }
            $cityNames = implode("', '", $cityNames);
        }


        $this->query = "SELECT t.id AS TransactionId,  t.type AS typeTransaction, ty.type AS Type, p.*, a.*, i.*, c.*, ty.*, t.*, pf.* 
                            FROM transactions t 
                            JOIN properties p ON t.properties_id = p.id 
                            JOIN addresses a ON p.addresses_id = a.id 
                            LEFT JOIN images i ON i.properties_id = p.id 
                            JOIN categories c ON p.categories_id = c.id 
                            JOIN types ty ON p.types_id = ty.id 
                            JOIN properties_features pf ON pf.properties_id = p.id
                            JOIN features f ON pf.features_id = f.id WHERE t.status = 'Ativo'";

        /**type => Aluguel|Venda */


        /**TypesData => tipo do Imovel, tabela TYPES */
        if (!empty($typesIds)) {
            // $typeIds = implode(',', $typesData);
            $this->query .= " AND p.types_id IN ({$typesIds})";
        }

        if (!empty($categoryIds)) {
            $this->query .= " AND p.categories_id IN ({$categoryIds})";
        }


        /**Cidade escolhida no Form, pode vir várias {Array} */
        if (!empty($cityNames)) {
            $this->query .= " AND a.city IN ('{$cityNames}')";
        }

        if (!empty($featuresData)) {
            $featureIds = implode(',', $featuresData);
            $this->query .= " AND pf.features_id IN ({$featureIds})";
        }

        if (!empty($type)) {
            $this->query .= " AND t.type = '{$type}'";
        }

        $this->query .= " GROUP BY t.id ORDER BY t.updated_at DESC";

        return $this;
    }



    //aqui!!!!

    public function comfortableProperties(int $propertiId): ?PropertiesComfortable
    {
        if ($propertiId) {
            return (new PropertiesComfortable())->findByProperties($propertiId);
        }
        return null;
    }


    public function comfortable(): ?Comfortable
    {

        return (new Comfortable())->find();
    }




    public function reportsProperties($dateFirst, $dateLast, $city = null, $state = null, $status = null)
    {
        $this->query = "SELECT * FROM properties p 
                  JOIN addresses a ON a.id = p.addresses_id 
                  WHERE (p.created_at > '{$dateFirst}' AND p.created_at < '{$dateLast}')";

        if (!empty($city)) {
            $this->query .= " AND (a.city = '{$city}' AND a.state = '{$state}')";
            // $this->query .= " AND a.city = '{$data['city']}'";
        }

        if (!empty($status) && $status != 'Geral') {
            $this->query .= " AND p.active = '{$status}'";
        }

        return $this;
    }

    public function transactionsPropertiesActive(?string $type)
    {

        $this->query = "SELECT t.id AS TransactionId,  t.type AS typeTransaction, ty.type AS Type, p.*, a.*, i.*, c.*, ty.*, t.* 
                            FROM transactions t 
                            JOIN properties p ON t.properties_id = p.id
                            JOIN addresses a ON p.addresses_id = a.id
                            LEFT JOIN images i ON i.properties_id = p.id
                            JOIN categories c ON p.categories_id = c.id
                            JOIN types ty ON p.types_id = ty.id
                            WHERE t.status = 'Ativo'";

        if (!empty($type)) {
            $this->query .= " && t.type = '{$type}'";
        }

        $this->query .= " GROUP BY t.id ORDER BY t.updated_at DESC";


        return $this;
    }

    public function propertiesFeatures()
    {

        $this->query = "SELECT * FROM properties p
                                JOIN properties_features pf ON pf.properties_id = p.id
                                JOIN features f ON f.id = pf.features_id
                                WHERE p.active = 'Ativo'";

        return $this;
    }

    /**Não Usar */
    // public function propertyProperties($propertieId)
    // {
    //     $this->query = "SELECT * FROM properties p
    //                     LEFT JOIN
    //                         addresses a ON p.addresses_id = a.id
    //                     LEFT JOIN
    //                         images i ON p.id = i.properties_id
    //                     LEFT JOIN
    //                         categories c ON p.categories_id = c.id
    //                     LEFT JOIN
    //                         types ty ON p.types_id = ty.id
    //                     LEFT JOIN
    //                         properties_comfortable pc ON p.id = pc.properties_id
    //                     LEFT JOIN
    //                         properties_features pf ON p.id = pf.properties_id
    //                     LEFT JOIN
    //                         properties_structures ps ON p.id = ps.properties_id
    //                     WHERE
    //                         p.id =  {$propertieId}";

    //     return $this;
    // }
}
