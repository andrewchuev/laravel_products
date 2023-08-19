# Laravel Product Management System

This project provides a product management system built on Laravel 8, featuring both an API and a web interface.
Key Features

- CRUD operations for products via a web interface.
- RESTful API for product management.
- Real-time product list updates using Broadcasting.
- Tests for both API and UI components.

Requirements

    PHP >= 8.1
    Laravel 10
    MySQL or a compatible database
    Composer
    Node.js and NPM
    Pusher (for broadcasting)

Installation

    Clone the repository:
    git clone [this repository link]

    Install dependencies:
    composer install
    npm install

    Set up the environment:
    Copy .env.example to .env and configure your database settings, as well as Pusher keys.

    Run migrations:
    php artisan migrate

    Start the server:
    php artisan serve

Usage

    Visit http://localhost:8000/products to access the product management interface.
    For API usage, make requests to http://localhost:8000/api/v1/products.

Testing

    Run php artisan test to execute the tests.

Additional Information

    For Broadcasting setup, follow the Laravel and Pusher documentation.
