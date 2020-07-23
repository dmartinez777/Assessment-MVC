<?php

namespace App\Models;

use App\Database\Database;

/**
 * Class Model
 */
class Model extends Database
{
    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->connect();
    }
}
