# MetricHub 📊

A modern, real-time website uptime and latency monitoring dashboard. Built with **Laravel 11**, **Vue 3**, and **Tailwind CSS**.

!

## Features
* **Real-time Monitoring:** Tracks website response times and HTTP status codes.
* **Automated Pings:** Custom Artisan command integrated with the Laravel Scheduler.
* **Interactive Charts:** Visual latency trends using Chart.js and Vue-ChartJS.
* **Status Badges:** Instant visual feedback on site health (Online/Offline).
* **Clean UI:** Responsive design built with Tailwind CSS and Vue 3 Composition API.

## Tech Stack
* **Backend:** PHP 8.2+, Laravel 11
* **Frontend:** Vue 3 (Vite), Chart.js, Tailwind CSS
* **Database:** SQLite (default) / MySQL
* **Tooling:** Axios for API communication, Laravel Scheduler for automation

## Installation

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/jicint/metric-hub.git]
   cd metric-hub
Install dependencies:

Bash

composer install
npm install
Environment Setup:

Bash

cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
Compile Assets:

Bash

npm run dev
Running the Monitor
To start the automated background pings, run the scheduler:

Bash

php artisan schedule:work
To manually trigger a check for all monitored sites:

Bash

php artisan monitors:ping
## Adding Monitors
Currently, monitors can be added via Laravel Tinker:

Bash

php artisan tinker --execute="\App\Models\Monitor::create(['name' => 'Google', 'url' => '[https://google.com](https://google.com)']);"
Developed by Jicin Thekkekara
