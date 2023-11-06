
# SPI RH CRM

Welcome to SPI RH CRM ! This guide will help you get up and running with our Laravel application.

## Prerequisites

Before you start, ensure you have the following software installed on your local machine:

- [PHP](https://www.php.net/downloads) (TS version recommended)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (LTS version recommended)
- [npm](https://www.npmjs.com/get-npm) (included with Node.js)
- [MySQL](https://dev.mysql.com/downloads/mysql/) or other supported databases
- [Git](https://git-scm.com/)

## Getting Started

1. Clone the repository:

   ```bash
   git clone https://github.com/AssouliDFK/spi-rh.git (private Project)
   ```

2. Change into the project directory:

   ```bash
   cd spi-rh
   ```

3. Install PHP dependencies:

   ```bash
   composer install
   ```

4. Create a `.env` file by copying the example:

   ```bash
   cp .env.example .env
   ```

5. Generate an application key:

   ```bash
   php artisan key:generate
   ```

6. Configure your `.env` file with your database connection settings and other configurations:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

7. Run database migrations and seed the database:

   ```bash
   php artisan migrate --seed
   ```

8. Install JavaScript dependencies and compile assets:

   ```bash
   npm install
   npm run dev
   ```

9. Start the development server:

   ```bash
   php artisan serve
   ```

10. Visit `http://localhost:8000` in your web browser to access the application.

## Additional Information

For more details and customization options, please refer to the official [Laravel documentation](https://laravel.com/docs).

## License

This project is open-source and available under the [MIT License](LICENSE).
```
