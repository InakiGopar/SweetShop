# OrganizaTe

## Description
This web application is designed to help small businesses efficiently organize and manage their inventory and orders. It features a clean, minimalist interface to enhance user experience. The main functionalities include:

- **Products Section**: Displays the business's available stock to customers.
- **Orders Section**: Allows users to easily place and manage orders.
- **User Registration**: Implemented with Laravel Breeze, supporting role-based access control (admin and default user).

## Objective
The goal of this application is to provide small businesses with a simple yet powerful tool to streamline their operations and improve customer interactions.

## Features
- Clear and intuitive interface.
- Role-based access (admin and user).
- Real-time management of products and orders.

## Dependencies

### PHP/Laravel Dependencies
- **PHP**: ^8.1
- **Laravel Framework**: ^10.10
- **Laravel Sanctum**: ^3.3
- **Laravel Tinker**: ^2.8
- **Livewire**: ^3.5
- **GuzzleHTTP**: ^7.2

#### Development Dependencies
- **FakerPHP**: ^1.9.1
- **Laravel Breeze**: ^1.29
- **Laravel Pint**: ^1.0
- **Laravel Sail**: ^1.18
- **Mockery**: ^1.4.4
- **PHPUnit**: ^10.1
- **Spatie Laravel Ignition**: ^2.0

### JavaScript and CSS Dependencies
- **Axios**: ^1.6.4
- **TailwindCSS**: ^3.1.0
- **PostCSS**: ^8.4.31
- **Autoprefixer**: ^10.4.2
- **Bootstrap Icons**: ^1.11.3
- **Vite**: ^5.0.0
- **@tailwindcss/forms**: ^0.5.2

## Installation

### Prerequisites
- PHP ^8.1 installed.
- Composer installed.
- Node.js and npm installed.

### Steps

1. **Clone the repository:**
   ```bash
   git clone <repository_url>
   cd <repository_folder>
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies:**
   ```bash
   npm install
   ```

4. **Set up the environment:**
   - Duplicate the `.env.example` file and rename it to `.env`.
   - Configure your database and other settings in the `.env` file.

5. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

6. **Run migrations:**
   ```bash
   php artisan migrate
   ```

7. **Link storage:**
   ```bash
   php artisan storage:link
   ```

8. **Build frontend assets:**
   ```bash
   npm run dev
   ```

9. **Run the development server:**
   ```bash
   php artisan serve
   ```

10. **Access the application:**
    Open your browser and navigate to `http://127.0.0.1:8000`.



