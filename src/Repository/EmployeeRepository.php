<?php

declare(strict_types=1);

namespace App\Repository;

use App\Command\CreateEmployeeCommand;
use App\Command\UpdateEmployeeCommand;
use App\Database\Connection;
use App\DTO\EmployeeDTO;
use App\DTO\Factory\EmployeeDTOFactory;
use Exception;
use PDO;
use PDOException;

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
            'name' => $createEmployeeCommand->name,
            'surname' => $createEmployeeCommand->surname,
            'email' => $createEmployeeCommand->email,
            'phoneNumber' => $createEmployeeCommand->phone_number,
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

    public function checkEmployeeId(int $employeeId): bool|array
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT 
                e.id AS e_id
            FROM 
                employee AS e
            WHERE 
                e.id = :employeeId
        SQL);

        $statement->execute([
            'employeeId' => $employeeId,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function checkCompanyId(int $companyId): bool|array
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT 
                c.id AS c_id
            FROM 
                company AS c
            WHERE 
                c.id = :companyId
        SQL);

        $statement->execute([
            'companyId' => $companyId,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function checkCompanyEmployee(int $employeeId, int $companyId): bool|array
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT 
                c_e.company_id AS c_id,
                c_e.employee_id AS e_id
            FROM 
                company_employee AS c_e
            WHERE 
                c_e.company_id = :companyId
            AND
                c_e.employee_id = :employeeId
        SQL
        );

        $statement->execute([
            'companyId' => $companyId,
            'employeeId' => $employeeId
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function assignEmployeeToCompany(int $employeeId, int $companyId): ?array
    {
        $statement = $this->db->prepare(<<<SQL
            INSERT INTO
                company_employee (employee_id, company_id)
            VALUES
                (:employeeId, :companyId) 
            RETURNING 
                :employeeId
        SQL);

        $statement->execute([
            'employeeId' => $employeeId,
            'companyId' => $companyId,
        ]);

        return null;
    }
}
