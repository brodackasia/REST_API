CREATE DATABASE company;

CREATE TABLE company (
    id SERIAL PRIMARY KEY,
    name VARCHAR (50) NOT NULL,
    vat_identification_number VARCHAR (20) NOT NULL UNIQUE,
    address VARCHAR (50) NOT NULL,
    city VARCHAR (30) NOT NULL,
    zip_code VARCHAR (10) NOT NULL
);

CREATE TABLE employee (
    id SERIAL PRIMARY KEY,
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
    FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE RESTRICT,
    PRIMARY KEY (company_id, employee_id)
);

INSERT INTO company (name, vat_identification_number, address, city, zip_code)
    VALUES ('Shop1', '1234567890', 'ul.Przykładowa 1', 'Pzykładowo', '11-111'),
           ('Shop2', '2345678901', 'ul.Przykładowa 2', 'Pzykładowo', '11-111');

INSERT INTO employee (name, surname, email, phone_number)
    VALUES ('Jan', 'Kowalski', 'Jan@Kowalski.pl', '123456789'),
           ('Jan', 'Nowak', 'Jan@Nowak.pl', '234567890');

INSERT INTO company_employee (company_id, employee_id)
    VALUES ('1', '1'),
           ('2', '2');