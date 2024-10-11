# Employee Management System

This project is a backend API server for managing employees, built using Laravel 11. It implements GraphQL for CRUD operations and user authentication via Passport. Users can perform various employee management operations, including creating employees, viewing a list of employees, updating and deleting records, and exporting/importing employee data to/from Excel.

## Features

-   **User Login**: Authentication via Laravel Passport.
-   **Employee Creation**: Users can create up to 10,000 employees using Faker.
-   **Employee Listing**: View a list of employees with GraphQL queries.
-   **Employee Deletion**: Remove employee records.
-   **Employee Update**: Edit employee details.
-   **Excel Export**: Export up to 10,000 employee records to an Excel file.
-   **Excel Import**: Import employee data from an Excel file.

## Technical Requirements

-   **Framework**: Laravel 11
-   **GraphQL Package**: [nuwave/lighthouse](https://lighthouse-php.com) for GraphQL implementation.
-   **Authentication**: Laravel Passport for user authentication and token management.
-   **Excel**: Laravel Excel package for importing and exporting employee data.

## Installation

1. Clone the repository:
    ```bash
    git clone git@github.com:katherinekhine/employee_management.git
    ```
2. Navigate to the project directory:
   cd employee-management-system
3. Install dependencies:
   composer install
4. Set up the .env file by copying the .env.example file and configuring your database connection.
   cp .env.example .env
5. Generate an application key:
   php artisan key:generate
6. Run database migrations:
   php artisan migrate
7. Install Passport:
   php artisan passport:install
8. Seed the database with 10,000 employees (using Faker):
   php artisan db:seed --class=EmployeeSeeder
9. Start the server:
   php artisan serve
