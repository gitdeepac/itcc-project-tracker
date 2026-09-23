# ITCC Project Tracker

A Laravel 11 REST API + React frontend for managing projects and tasks, with Sanctum token auth.
This repository contains two applications:
- Laravel backend in the root folder
- React frontend in the frontend/ folder

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

git clone https://github.com/gitdeepac/itcc-project-tracker.git
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

php artisan serve

#### After this it will create this username and password

Admin user: `admin@itcc.test` / `password`
Projects and associated tasks

Run the backend 

### 6. Set up the frontend

```bash
cd frontend
npm install
npm run dev
```

> Note: The Vite proxy is configured to forward /api requests to http://127.0.0.1:8000. 
> If your backend runs on a different port, update the target in frontend/vite.config.js.

## 7. Key Decisions

- Totals are calculated directly from the database on each request. This is simple and fast enough for the current data size. If the dataset grows significantly, we can add caching later.
- When all tasks under a project are marked as done, the project status is automatically changed to completed. This is handled through a TaskMarkedDone event and AutoCompleteProject listener, which keeps the controller clean and makes the business rule easier to test separately.
- The database queue driver is used for the overdue project logging job.
- Tasks are nested under projects using /api/projects/{project}/tasks. This makes the relationship clear in the API and ensures that each task belongs to a specific project.



## 8. What's Not Done, What's Rough, What's Next

**Not done**
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

- | 1 | Project setup, migrations, models, factories, seeders | - 1.20 h
- | 2 | Sanctum auth, controllers, routes | 30 min
- | 3 | Form Requests, API Resources, summary endpoint | - 40 min
- | 4 | Event + Listener for auto-complete rule | - 30 min
- | 5 | Queued job for overdue project logging | - 30 min
- | 6 | Feature tests | - 30 min
- | 7 | React frontend | - 30 min
- | 8 | README, CODE_REVIEW, PLAN docs | - 40 min

**Total: ~5 hours**

## 10. Declaration

I confirm that I completed this assessment myself without the use of AI coding assistants (including but not limited to Claude Code, Codex, GitHub Copilot, ChatGPT and Cursor), and that I am able to explain and modify any part of this code in an interview.

**Deepak Patil**
21 September 2026


#### - Change on 23 Sep

- Updated the project name consistancy across the project so that It will show data properly. - 20 min
- Update scoped route for task so that this can be help preventing wrong relation action. - 10 min
- Updated the Readme to get better understanding when installing fresh setup as well made changes into config file to remove the local path - 30 min 
- Added test cases for update / delete task into TaskTest.php - 35 min
- Added new test case to check the api is returning key and value for project summary to check the ITEM 3 validation - 20 min.
- Update CODE REVIEW - update with severity ranking - 20 min
- Update PLAN.md - address request of changing story points to hours. - 30 min
- Declaration re-signing - 5 min


#### - Change on 23 Sep - round 2

- Item 1 – Project Create: Standardised the project name field across API requests, validation, responses, and tests. Updated the related test, and all tests are now passing. - 30 min.
- Item 3 – Project Summary: Updated the summary endpoint to return the project name consistently and added a test to verify the project name across the relevant endpoints. - 25 min
- Item 4 – Fresh Clone Setup: Fixed the Laravel and React Vite configurations, removed machine-specific paths, updated the README and Docker configuration, and verified the setup from a fresh installation. - 45 min
- Update yaml for docker deployment - 40 min

