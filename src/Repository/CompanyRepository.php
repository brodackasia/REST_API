<?php

declare(strict_types=1);

namespace App\Repository;

use App\Command\CreateCompanyCommand;
use App\Command\UpdateCompanyCommand;
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
                c.zip_code,
                array_to_string(array_agg(ce.employee_id), ',') AS employees_ids
            FROM
                company AS c
            LEFT JOIN
                company_employee AS ce ON ce.company_id = c.id
            WHERE
                    c.id = :companyId
            GROUP BY
                c.id
        SQL);

        $statement->execute([
            'companyId' => $companyId,
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
                c.zip_code,
                array_to_string(array_agg(ce.employee_id), ',') AS employees_ids
            FROM
                company AS c
            LEFT JOIN
                company_employee AS ce ON ce.company_id = c.id
            GROUP BY
                c.id
        SQL);

        $statement->execute();

        return CompanyDTOFactory::createCollectionFromArray(
            $statement->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    public function createCompanyData(CreateCompanyCommand $createCompanyCommand): int
    {
        $statement = $this->db->prepare(<<<SQL
            INSERT INTO 
                company ("name", vat_identification_number, address, city, zip_code)
            VALUES 
                (:name, :vatIdentificationNumber, :address, :city, :zipCode)
            RETURNING 
                id 
        SQL);

        $statement->execute([
            'name' => $createCompanyCommand->getName(),
            'vatIdentificationNumber' => $createCompanyCommand->getVatIdentificationNumber(),
            'address' => $createCompanyCommand->getAddress(),
            'city' => $createCompanyCommand->getCity(),
            'zipCode' => $createCompanyCommand->getZipCode(),
        ]);

        $createdCompanyId = $statement->fetch(PDO::FETCH_ASSOC);

        return $createdCompanyId['id'];
    }

    public function updateCompanyData(UpdateCompanyCommand $updateCompanyCommand): void
    {
        $statement = $this->db->prepare(<<<SQL
            UPDATE 
                company AS c
            SET 
                "name" = :name,
                vat_identification_number = :vatIdentificationNumber,
                address = :address,
                city = :city,
                zip_code = :zipCode
            WHERE
                c.id = :companyId
        SQL);

        $statement->execute([
            'name' => $updateCompanyCommand->getName(),
            'vatIdentificationNumber' => $updateCompanyCommand->getVatIdentificationNumber(),
            'address' => $updateCompanyCommand->getAddress(),
            'city' => $updateCompanyCommand->getCity(),
            'zipCode' => $updateCompanyCommand->getZipCode(),
            'companyId' => $updateCompanyCommand->getCompanyId(),
        ]);
    }

    public function deleteCompanyData(int $companyId): void
    {
        $statement = $this->db->prepare(<<<SQL
            DELETE FROM
                company AS c
            WHERE 
                c.id = :companyId
        SQL);

        $statement->execute([
           'companyId' => $companyId,
        ]);
    }

    public function doesVatIdentificationNumberExists(string $vatIdentificationNumber): bool
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT 
                1
            FROM 
                company AS c
            WHERE 
                c.vat_identification_number = :vatIdentificationNumber
        SQL);

        $statement->execute([
            'vatIdentificationNumber' => $vatIdentificationNumber,
        ]);

        return (bool) $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function doesCompanyExists(int $companyId): bool
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT
                1
            FROM
                company AS c 
            WHERE 
                c.id = :companyId
        SQL);

        $statement->execute([
            'companyId' => $companyId,
        ]);

        return (bool) $statement->fetch(PDO::FETCH_ASSOC);
    }
}
