<?php

namespace Source\Models;

use Source\Core\Model;

class ResponseService extends Model
{
    public function __construct()
    {
        parent::__construct("response_service", ["id"], ["users_id", "customer_service_id", "response"]);
    }
}
