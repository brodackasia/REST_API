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

    public function createCompanyData(CompanyCommand $companyCommand): array
    {
        $statement = $this->db->prepare(<<<SQL
            INSERT INTO 
                company ("name", vat_identification_number, address, city, zip_code)
            VALUES 
                (:name, :vat_identification_number, :address, :city, :zip_code)
            RETURNING 
                id AS createdCompanyId
        SQL);

        $statement->execute([
            'name' => $companyCommand->getName(),
            'vat_identification_number' => $companyCommand->getVatIdentificationNumber(),
            'address' => $companyCommand->getAddress(),
            'city' => $companyCommand->getCity(),
            'zip_code' => $companyCommand->getZipCode()
        ]);

        $createdCompanyId = [
            'createdCompanyId' => $statement->fetch(PDO::FETCH_ASSOC)
        ];

        return $createdCompanyId['createdCompanyId'];
    }
}
