<?php

declare(strict_types=1);

namespace App\Repository;

use App\Command\CompanyCommand;
use App\Database\Connection;
use App\DTO\CompanyDTO;
use App\DTO\Factory\CompanyDTOFactory;
use PDO;

class CompanyRepository
{
    private Connection $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function getCompanyData(int $companyId): CompanyDTO
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT 
                c.id, 
                c."name", 
                c.vat_identification_number, 
                c.address, 
                c.city, 
                c.zip_code
            FROM 
                company AS c
            WHERE
                c.id = :companyId
        SQL);

        $statement->execute([
            'companyId' => $companyId
        ]);

        return CompanyDTOFactory::createFromArray(
            $statement->fetch(PDO::FETCH_ASSOC)
        );
    }

    public function getCompaniesData(): array
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT 
                c.id, 
                c."name", 
                c.vat_identification_number, 
                c.address, 
                c.city, 
                c.zip_code            
            FROM 
                company AS c
        SQL);

        $statement->execute();

        return CompanyDTOFactory::createCollectionFromArray(
            $statement->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    public function createCompanyData(CompanyCommand $companyCommand): int
    {
        $statement = $this->db->prepare(<<<SQL
            INSERT INTO 
                company ("name", vat_identification_number, address, city, zip_code)
            VALUES 
                (:name, :vat_identification_number, :address, :city, :zip_code)
            RETURNING 
                id 
        SQL);

        $statement->execute([
            $companyCommand->getCompanyName(),
            $companyCommand->getCompanyVatIdentificationNumber(),
            $companyCommand->getCompanyAddress(),
            $companyCommand->getCompanyCity(),
            $companyCommand->getCompanyZipCode()
        ]);

        $createdCompanyId = $statement->fetch(PDO::FETCH_ASSOC);

        return $createdCompanyId['id'];
    }
}
