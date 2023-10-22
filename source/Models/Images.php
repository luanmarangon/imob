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
        return $find;
    }

    public function images(): ?string
    {
        if ($this->path && file_exists(__DIR__ . "/../../" . CONF_UPLOAD_DIR . "/{$this->path}"));
        return $this->path;
    }
}
