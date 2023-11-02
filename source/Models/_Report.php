<?php


namespace Source\Models;

use Source\Core\Model;

class Report extends Model
{

    public function __construct()
    {
    }


    public function reportsProperties($dateFirst, $dateLast, $city = null, $state = null, $status = null)
    {
        // $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $query = "SELECT * FROM properties p 
                  JOIN addresses a ON a.id = p.addresses_id 
                  WHERE (p.created_at > '{$dateFirst}' AND p.created_at < '{$dateLast}')";

        if (!empty($data['city'])) {
            $query .= " AND (a.city = '{$city}' AND a.state = '{$state}')";
            // $query .= " AND a.city = '{$data['city']}'";
        }

        if (!empty($status) && $status != 'Geral') {
            $query .= " AND p.active = '{$status}'";
        }

        return $query;
    }
}
