# Internship Task Monitoring System

A web-based application designed to manage and monitor tasks for vocational high school interns. Built with **Laravel 12** and **Bootstrap 5**, and highly optimized for lightweight deployment on shared hosting environments.

---

## Features

### 👨‍💼 Admin Features (Supervisor)
- **School & Lab CRUD:** Add and manage partner school data and laboratory division placements. Fully supports *cascade delete* (deleting a school automatically removes its associated student data).
- **Grade & Progress Tracking:** Automated percentage indicators to monitor approved student tasks in *real-time*.
- **Task Bulk Actions:** Streamline your workflow by accepting or rejecting dozens of student submissions simultaneously with a single click.
- **Storage Cleaner:** A dedicated feature to wipe all task evidence image files from the server at once, preventing hosting storage quota overload.
- **PDF Export:** Export cumulative grade recaps for all students into PDF format via DOMPDF.
- **Modern UI:** All delete confirmations utilize elegant animated pop-ups from **SweetAlert2**, replacing the outdated native browser `confirm()` dialogue.

### 🎓 Intern Features (Student)
- **Task Evidence Upload:** A dedicated dashboard for interns to submit image proofs of their completed tasks.
- **Auto-Lock System:** The upload button is automatically locked from the backend if the submission time has passed the admin-defined *due date*.

---

## Hosting Folder Structure (Split-Folder Setup)

This project utilizes a split-folder architecture on shared hosting for enhanced security, preventing direct public URL access to the Laravel core files:

```text
└── laravel/                # Core Laravel System 
    ├── app/                # Controllers, Models, & Middleware
    ├── bootstrap/          # System initialization & cache
    ├── config/             # All framework configurations
    ├── resources/          # Blade view files & raw texts
    └── storage/            # Task evidence uploads & login sessions
```

---

## 🚀 Tech Stack

- **Framework:** Laravel 12.x
- **Runtime:** PHP 8.3.x
- **Database:** MySQL
- **Frontend:** Bootstrap 5.3 & SweetAlert2 *(via production CDN to save hosting bandwidth)*
- **Library:** Barryvdh DomPDF & FontAwesome 6.5

---

## 💻 Local Installation Guide

Follow these steps to run the project in your local environment:

1. **Clone the Repository:**
```bash
git clone https://github.com/FredySaputra/InternshipTaskMonitoringSystem.git
cd InternshipTaskMonitoringSystem
```

2. **Install Composer Dependencies:**
```bash
composer install
```

3. **Environment Configuration:**
Copy the `.env.example` file to `.env`, then configure your database credentials inside.
```bash
cp .env.example .env
php artisan key:generate
```

4. **Run Migrations & Seeders:**
```bash
php artisan migrate --seed
```

5. **Clear Cache & Run Server:**
```bash
php artisan route:clear
php artisan serve
```

Once the server is running, open `http://127.0.0.1:8000` in your browser.

---
<p align="center">
  <b>Fredy Dwi Saputra @ 2026</b>
</p>
