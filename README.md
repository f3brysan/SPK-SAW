# SPK-SAW

A Decision Support System (DSS) using the Simple Additive Weighting (SAW) method, built with Laravel.

## Features

- Manage criteria and alternatives
- Assign weights and scores
- Calculate rankings using the SAW method
- User-friendly web interface

## Requirements

- PHP >= 8.0
- Composer
- Laravel >= 9.x
- MySQL/MariaDB

## Installation

1. Clone the repository:
    ```
    git clone https://github.com/yourusername/SPK-SAW.git
    cd SPK-SAW
    ```

2. Install dependencies:
    ```
    composer install
    ```

3. Copy `.env.example` to `.env` and configure your database settings.

4. Generate application key:
    ```
    php artisan key:generate
    ```

5. Run migrations:
    ```
    php artisan migrate
    ```

6. Serve the application:
    ```
    php artisan serve
    ```

## Usage

- Access the web interface at `http://localhost:8000`
- Add criteria, alternatives, and input their values
- View the ranking results calculated using the SAW method

## License

This project is open-source and available under the [MIT license](LICENSE).