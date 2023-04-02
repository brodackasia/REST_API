<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class Connection extends PDO
{
    public function __construct(
        string $dsn,
        string $database,
        string $host,
        string $port,
        string $username = null,
        string $password = null
    ) {
        parent::__construct(
            sprintf(
            '%s:dbname=%s;host=%s;port=%s',
                $dsn,
                $database,
                $host,
                $port,
            ),
            $username,
            $password
        );
    }
}
