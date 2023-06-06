<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection;
use PDO;

readonly class AssignmentRepository
{
    public function __construct(
        public Connection $db
    ) {}

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

    public function deleteEmployeeCompanyAssignment(int $employeeId, int $companyId): void
    {
        $statement = $this->db->prepare(<<<SQL
            DELETE FROM
                company_employee AS c_e
            WHERE 
                c_e.employee_id = :employeeId
            AND
                c_e.company_id = :companyId
        SQL);

        $statement->execute([
            'employeeId' => $employeeId,
            'companyId' => $companyId,
        ]);
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
            'employeeId' => $employeeId,
        ]);

        return (bool) $statement->fetch(PDO::FETCH_ASSOC);
    }
}