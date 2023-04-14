<?php

declare(strict_types=1);

namespace App\Repository;

use App\Command\EmployeeCommand;
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
                e.phone_number
            FROM
                employee AS e
            WHERE 
                e.id = :employeeId
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
                e.phone_number
            FROM 
                employee AS e
            ORDER BY 
                e.id
        SQL);

        $statement->execute();

        return EmployeeDTOFactory::createCollectionFromArray(
            $statement->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    public function createEmployeeData(EmployeeCommand $employeeCommand): int
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
            'name' => $employeeCommand->getName(),
            'surname' => $employeeCommand->getSurname(),
            'email' => $employeeCommand->getEmail(),
            'phoneNumber' => $employeeCommand->getPhoneNumber()
        ]);

        $createdEmployeeId = $statement->fetch(PDO::FETCH_ASSOC);

        return $createdEmployeeId ['id'];
    }
}
