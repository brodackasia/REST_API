CREATE DATABASE company;

CREATE TABLE company (
    id INT PRIMARY KEY,
    name VARCHAR (50) NOT NULL,
    vat_identification_number VARCHAR (20) NOT NULL UNIQUE,
    address VARCHAR (50) NOT NULL,
    city VARCHAR (30) NOT NULL,
    zip_code VARCHAR (10) NOT NULL
);

CREATE TABLE employee (
    id INT PRIMARY KEY,
    name VARCHAR (30) NOT NULL,
    surname VARCHAR (50) NOT NULL,
    email VARCHAR (50) NOT NULL,
    phone_number VARCHAR (20)
);

CREATE TABLE company_employee (
    company_id INT NOT NULL,
    employee_id INT NOT NULL,
    --jeśli usunę firmę z tabeli Company -> usuwa połączenie firmy z pracownikami,
    FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE,
    --nie da się usunąć pracownika dopóki jest on przypisany do firmy
    FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE,
    PRIMARY KEY (company_id, employee_id)
);

