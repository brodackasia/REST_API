<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection;
use App\DTO\CompanyDTO;
use App\DTO\Factory\CompanyDTOFactory;
use PDO;

class CompanyRepository
{
    private Connection $db;

    function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function getCompanyData(int $companyId): CompanyDTO
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT 
                id, "name", vat_identification_number, address, city, zip_code
            FROM 
                company as c
            WHERE
                c.id = :companyId
        SQL);

        $statement->execute([
            'companyId' => $companyId
        ]);

        return CompanyDTOFactory::createCompanyDTO(
            $statement->fetch(PDO::FETCH_ASSOC)
        );
    }
}
