<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection;
use PDO;
class CompanyRepository
{
    public Connection $db;

    function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function getCompanyData()
    {

    }
}