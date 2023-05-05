****REST_API****

Aplikacja służąca do zarządzania firmami i ich pracownikami.

**Stack technologiczny**

    PHP w wersji 8.2
    Composer w wersji 2.2
    Symfony w wersji 5.5
    Baza danych PostgreSQL

**Instalacja**

1. Sklonuj repozytorium: git clone https://github.com/brodackasia/REST_API.git
2. Przejdź do katalogu projektu: cd REST_API
3. Zainstaluj zależności: composer install
4. Utwórz bazę danych company i wykonaj skrypty sql zawarte w pliku database.sql w folderze REST_API/sql
5. Stwórz plik .env i skonfiguruj w nim połączenie do bazy danych zgodnie z szablonem w pliku .env.mockup
6. Uruchom serwer deweloperski: symfony server:start

**Instrukcja**

Wyświetlanie danych wszystkich firm:

    GET /companies

Wyświetlanie danych firmy o zadanym id:

    GET /company/{companyId}

Aktualizacja danych firmy o zadanym id:

    PUT /company/{companyId}

Parametry:

| Nazwa parametru             | Typ danych | Opis                                          |
|-----------------------------|------------|-----------------------------------------------|
| `name`                      | string     | Wymagany. Nazwa firmy.                        |
| `vat_identification_number` | string     | Wymagany. Numer NIP.                          |
| `address`                   | string     | Wymagany. Adres firmy - ulica, numer budynku. |
| `city`                      | string     | Wymagany. Adres firmy - miasto.               |
| `zip_code`                  | string     | Wymagany. Adres firmy - kod pocztowy.         |

Usuwanie danych firmy o zadanym id:
    
    DELETE /company/{companyId}

Tworzenie danych firmy o podanych parametrach:

    POST /company

Parametry:

| Nazwa parametru             | Typ danych | Opis                                          |
|-----------------------------|------------|-----------------------------------------------|
| `name`                      | string     | Wymagany. Nazwa firmy.                        |
| `vat_identification_number` | string     | Wymagany. Numer NIP.                          |
| `address`                   | string     | Wymagany. Adres firmy - ulica, numer budynku. |
| `city`                      | string     | Wymagany. Adres firmy - miasto.               |
| `zip_code`                  | string     | Wymagany. Adres firmy - kod pocztowy.         |

Wyświetlanie danych wszystkich pracowników:

    GET /employees

Wyświetlanie danych pracownika o zadanym id:

    GET /employee/{employeeId}

Aktualizacja danych pracownika o zadanym id:

    PUT /employee/{employeeId}

Parametry: 

| Nazwa parametru | Typ danych | Opis                                   |
|-----------------|------------|----------------------------------------|
| `name`          | string     | Wymagany. Imię pracownika.             |
| `surname`       | string     | Wymagany. Nazwisko pracownika.         |
| `email`         | string     | Wymagany. Adres email pracownika.      |
| `phone_number`  | float      | Opcjonalny. Numer telefonu pracownika. |

Usuwanie danych pracownika o zadanym id:

    DELETE /employee/{employeeId}

Tworzenie danych pracownika o podanych parametrach:

    POST /employee

Parametry:

| Nazwa parametru | Typ danych | Opis                                   |
|-----------------|------------|----------------------------------------|
| `name`          | string     | Wymagany. Imię pracownika.             |
| `surname`       | string     | Wymagany. Nazwisko pracownika.         |
| `email`         | string     | Wymagany. Adres email pracownika.      |
| `phone_number`  | float      | Opcjonalny. Numer telefonu pracownika. |

Tworzenie połączenia między pracownikiem a firmą:

    POST /assign/{employeeId}/{companyId}
