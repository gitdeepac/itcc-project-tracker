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


### 5. Run migrations, seed and start the backend

php artisan migrate:fresh --seed

#### After this it will create this username and password

Admin user: `admin@itcc.test` / `password`
Projects and associated tasks

### 6. Set up the frontend

```bash
cd frontend
npm install
npm run dev
```

## 7. Key Decisions

- Totals are calculated directly from the database on each request. This is simple and fast enough for the current data size. If the dataset grows significantly, we can add caching later.
- When all tasks under a project are marked as done, the project status is automatically changed to completed. This is handled through a TaskMarkedDone event and AutoCompleteProject listener, which keeps the controller clean and makes the business rule easier to test separately.
- The database queue driver is used for the overdue project logging job.
- Tasks are nested under projects using /api/projects/{project}/tasks. This makes the relationship clear in the API and ensures that each task belongs to a specific project.



## 8. What's Not Done, What's Rough, What's Next

- Frontend runs locally but is not deployed to cPanel
- No member self-registration — users are seeded only
- No automated scheduled reminders — the overdue check is triggered manually

**What's rough**
- The React frontend is functional but minimal — no loading skeletons, limited error handling on the UI
- The summary endpoint recalculates on every request — no caching
- No pagination on the projects list

**What I'd do next with another day**
- Add pagination to `GET /api/projects`
- Add proper error boundaries in React
- Write a scheduled command to auto-run the overdue check daily
- Add a `POST /api/logout-all` endpoint to revoke all tokens

## 9. Time Log

Completed in one session on the night of 20–21 September 2026, approximately 9pm to 1:45am AEST.

| 1 | Project setup, migrations, models, factories, seeders |
| 2 | Sanctum auth, controllers, routes |
| 3 | Form Requests, API Resources, summary endpoint |
| 4 | Event + Listener for auto-complete rule |
| 5 | Queued job for overdue project logging |
| 6 | Feature tests |
| 7 | React frontend |
| 8 | README, CODE_REVIEW, PLAN docs |

**Total: ~5 hours**

## 10. Declaration

I built this project myself over the course of this assessment. All code was written by me. I used the Laravel and React documentation for reference, and standard development tools including Postman for API testing.

**Deepak Patil**
21 September 2026

