<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# YouTube Content Manager

## Project Overview
YouTube Content Manager is a Laravel-based web application designed to manage and share YouTube-related data efficiently. The system consists of an admin panel with two key pages:

### Features
1. **Add Details Page:**
   - Admin can input details such as Date, Topic, Link, Category, Speaker, and Experience Sharing Person.
   - Supports bulk data upload via an Excel file.

2. **List Page:**
   - Displays all stored YouTube-related data in a table format.
   - Each row has two actions:
     - **Delete:** Removes the entry from the database.
     - **Share on WhatsApp:** Sends the data via WhatsApp using the [Fonnte API](https://fonnte.com/).

## Installation Guide

### Prerequisites
- PHP (>=8.0)
- Composer
- Laravel Framework
- MySQL Database
- Node.js and npm (for frontend dependencies)

### Steps to Install
1. Clone the repository:
   ```bash
   git clone https://github.com/takshasalaliya/YouTube-Content-Manager
   cd youtube-content-manager
   ```
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Copy the environment file and configure the database:
   ```bash
   cp .env.example .env
   ```
   Update `.env` file with database credentials.

4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. Run the server:
   ```bash
   php artisan serve
   ```

## Admin Login Credentials
- **Email:** [admin@gmail.com](mailto:admin@gmail.com)
- **Password:** Harinadas36

## Fonnte API Setup
1. Create an account at [Fonnte](https://fonnte.com/).
2. Obtain the API key from your Fonnte dashboard.
3. Add the API key in the `UserController.php` file.

## Usage
- Navigate to `http://127.0.0.1:8000/` to access the admin panel.
- Use the provided credentials to log in.
- Add YouTube-related details manually or via Excel upload.
- View the data in a table and either delete or share it on WhatsApp.

## License
This project is open-source and available under the [MIT License](LICENSE).