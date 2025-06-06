
# Technical Exam - CRUD Project

A simple guide to help you install and run the project locally.

---

## Installation Guide

Follow these steps to get the project up and running on your local machine.

### 1. Clone the Repository

Create a folder where you want to store the project, then navigate to it:

```bash
cd /path/to/your/folder
```

Initialize a git repository and pull the source code:

```bash
git init
git remote add origin https://github.com/itsmekentoy/exam_crud.git
git pull origin main
```

### 2. Environment Setup

Make a copy of the example environment file:

```bash
cp .env.example .env
```

Edit the `.env` file to configure your database and other environment variables as needed.

### 3. Install Dependencies

Install PHP dependencies with Composer:

```bash
composer install
```

Install JavaScript dependencies with npm:

```bash
npm install
```

### 4. Application Setup

Generate the application key:

```bash
php artisan key:generate
```

Run the database migrations:

```bash
php artisan migrate
```

### 5. Build Assets and Run the Server

Compile frontend assets:

```bash
npm run dev
```

Start the Laravel development server:

```bash
php artisan serve
```

---

## Usage

Open your browser and go to:

```
http://localhost:8000
```

You should see the application running!

---

## Notes

- Make sure you have PHP, Composer, Node.js, and npm installed before starting.
- Configure your database credentials properly in the `.env` file.
- If you encounter permission issues, try running commands with appropriate permissions or use a terminal with admin rights.

---

