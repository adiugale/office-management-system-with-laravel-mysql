# Office Management System (Laravel & MySQL)

## Project Overview

This project is a basic Office Management System developed using Laravel and MySQL. The system allows users to manage companies and employees, including the relationship between them. It also includes features like search, pagination, filtering, and dynamic location selection using an external API.

---

## Features

### Company and Employee Management

* Create, view, update, and delete companies
* Create, view, update, and delete employees
* Assign employees to a company
* Assign a manager to an employee (self-referencing relationship)

---

### DataTables Integration

* Employee list displayed using DataTables
* Pagination support
* Search functionality
* Filter employees by company or position

---

### Location Selection

* Dynamic selection of Country, State, and City
* Integrated using an external API (Universal Tutorial API)
* Used in employee create and edit forms

---

## Technologies Used

* Backend: Laravel
* Database: MySQL
* Frontend: HTML, Tailwind CSS or Bootstrap
* Plugin: DataTables (jQuery)
* API: Universal Tutorial API

---

## Database Structure

### Company Table

* id
* name
* location
* created_at
* updated_at

### Employee Table

* id
* name
* email
* position
* company_id
* manager_id
* country
* state
* city
* created_at
* updated_at

---

## Relationships

* An employee belongs to a company
* An employee can have a manager (another employee)

---

## Installation and Setup

1. Clone the repository

bash
git clone https://github.com/yourusername/office-management-system-laravel.git


2. Go to the project directory

bash
cd office-management-system-laravel


3. Install dependencies

bash
composer install


4. Create environment file

bash
cp .env.example .env


5. Configure database in the .env file

6. Run migrations

bash
php artisan migrate


7. Start the development server

bash
php artisan serve


8. Open the project in browser
   http://localhost:8000

---

## Usage

* First, create companies
* Then, add employees and assign a company and manager
* Use the employee list to search, filter, and navigate through records

---

## Project Structure

* app/Models: Contains database models
* app/Http/Controllers: Contains application logic
* resources/views: Contains Blade templates
* routes/web.php: Defines application routes
