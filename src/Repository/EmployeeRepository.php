<?php

declare(strict_types=1);

namespace App\Repository;

use App\Command\CreateEmployeeCommand;
use App\Command\UpdateEmployeeCommand;
use App\Database\Connection;
use App\DTO\EmployeeDTO;
use App\DTO\Factory\EmployeeDTOFactory;
use PDO;

class EmployeeRepository
{
    private Connection $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function getEmployeeData(int $employeeId): EmployeeDTO
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT
                e.id,
                e."name",
                e.surname,
                e.email,
                e.phone_number,
                array_to_string(array_agg(ce.company_id), ',') AS companies_ids
            FROM
                employee AS e
            LEFT JOIN
                company_employee AS ce ON ce.employee_id = e.id
            WHERE
                    e.id = :employeeId
            GROUP BY
                e.id
        SQL);

        $statement->execute([
            'employeeId' => $employeeId,
        ]);

        return EmployeeDTOFactory::createFromArray(
            $statement->fetch(PDO::FETCH_ASSOC)
        );
    }

    public function getEmployeesData(): array
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT
                e.id,
                e."name",
                e.surname,
                e.email,
                e.phone_number,
                array_to_string(array_agg(ce.company_id), ',') AS companies_ids
            FROM
                employee AS e
            LEFT JOIN
                company_employee AS ce ON ce.employee_id = e.id
            GROUP BY
                e.id
        SQL);

        $statement->execute();

        return EmployeeDTOFactory::createCollectionFromArray(
            $statement->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    public function createEmployeeData(CreateEmployeeCommand $createEmployeeCommand): int
    {
        $statement = $this->db->prepare(<<<SQL
           INSERT INTO 
               employee ("name", surname, email, phone_number) 
           VALUES 
               (:name, :surname, :email, :phoneNumber)
           RETURNING 
               id
        SQL);

        $statement->execute([
            'name' => $createEmployeeCommand->getName(),
            'surname' => $createEmployeeCommand->getSurname(),
            'email' => $createEmployeeCommand->getEmail(),
            'phoneNumber' => $createEmployeeCommand->getPhoneNumber(),
        ]);

        $createdEmployeeId = $statement->fetch(PDO::FETCH_ASSOC);

        return $createdEmployeeId['id'];
    }

    public function updateEmployeeData(UpdateEmployeeCommand $updateEmployeeCommand): ?int
    {
        $statement = $this->db->prepare(<<<SQL
             UPDATE 
                employee
             SET 
                "name" = :name,
                surname = :surname,
                email = :email,
                phone_number = :phoneNumber
             WHERE 
                 id = :employeeId
             RETURNING 
                id;
        SQL);

        $statement->execute([
            'name' => $updateEmployeeCommand->getName(),
            'surname' => $updateEmployeeCommand->getSurname(),
            'email' => $updateEmployeeCommand->getEmail(),
            'phoneNumber' => $updateEmployeeCommand->getPhoneNumber(),
            'employeeId' => $updateEmployeeCommand->getEmployeeId(),
        ]);

        $updatedEmployeeData = $statement->fetch(PDO::FETCH_ASSOC);

        return $updatedEmployeeData['id'] ?? null;
    }

    public function deleteEmployeeData(int $employeeId): ?int
    {
        $statement = $this->db->prepare(<<<SQL
            DELETE FROM
                employee
            WHERE
                employee.id = :employeeId
            RETURNING 
                id
        SQL);

        $statement->execute([
            'employeeId' => $employeeId
        ]);

        $deletedEmployeeId = $statement->fetch(PDO::FETCH_ASSOC);

        return $deletedEmployeeId['id'] ?? null;
    }

    public function doesEmployeeExist(int $employeeId): bool
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT 
                1
            FROM 
                employee AS e
            WHERE 
                e.id = :employeeId
        SQL);

        $statement->execute([
            'employeeId' => $employeeId,
        ]);

        return (bool)$statement->fetch(PDO::FETCH_ASSOC);
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

        return (bool)$statement->fetch(PDO::FETCH_ASSOC);
    }

    public function doesEmployeeCompanyAssignmentExist(int $employeeId, int $companyId): bool
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT 
                1
            FROM 
                company_employee AS c_e
            WHERE 
                c_e.company_id = :companyId
            AND
                c_e.employee_id = :employeeId
        SQL);

        $statement->execute([
            'companyId' => $companyId,
            'employeeId' => $employeeId
        ]);

        return (bool)$statement->fetch(PDO::FETCH_ASSOC);
    }

    public function assignEmployeeToCompany(int $employeeId, int $companyId): void
    {
        $statement = $this->db->prepare(<<<SQL
            INSERT INTO
                company_employee (employee_id, company_id)
            VALUES
                (:employeeId, :companyId) 
        SQL);

        $statement->execute([
            'employeeId' => $employeeId,
            'companyId' => $companyId,
        ]);
    }
}
