# ITCC Project Tracker

A Laravel 11 REST API + React frontend for managing projects and tasks, with Sanctum token auth.

## Requirements

- PHP 8.2+
- Composer
- MySQL 8 or MariaDB 10.6+
- Node.js 18+
- XAMPP (or any local PHP/MySQL stack)

## Stack

- **Backend:** Laravel 11, PHP 8.2, Sanctum
- **Frontend:** React 18, Vite, Axios
- **Database:** MySQL 8 / MariaDB 10.6
- **Queue:** Database driver
- **Auth:** Sanctum token auth

## Local Setup (Plain PHP/MySQL — XAMPP)

### 1. Clone the repository

git clone https://github.com/your-username/itcc-project-tracker.git
cd itcc-project-tracker

### 2. Install PHP dependencies

cd itcc_project_tracker
composer install

### 3. Environment setup

cp .env.example .env
php artisan key:generate


Edit `.env` and set your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_app
DB_USERNAME=root
DB_PASSWORD=

### 4. Create the database into phpmyadmin / extenal database UI client


### 5. Run migrations and seed

php artisan migrate:fresh --seed

#### After this it will create this username and password

Admin user: `admin@itcc.test` / `password`
Projects and associated tasks

### 6. Start the backend

### 7. Set up the frontend

```bash
cd frontend
npm install
npm run dev
```


