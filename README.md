
# 📝 Task Management System Documentation

## Overview

Welcome to the **Task Management System**! This project is a comprehensive solution for managing tasks, designed with scalability and performance in mind. Below, you'll find all the information you need to set up and run the project on your local environment.

## 🛠️ Tools & Technologies

This project has been built using the following technologies:

- **Laravel** - A robust PHP framework for web applications.
- **Livewire** - A full-stack framework for Laravel that makes building dynamic interfaces simple, without leaving the comfort of Laravel.
- **Tailwind CSS** - A utility-first CSS framework packed with classes that can be composed to build any design, directly in your markup.
- **Redis** - An in-memory data structure store used for caching and queue management.
- **WebSocket** & **Laravel Echo** - For real-time broadcasting of events.
- **Pest** - A delightful PHP testing framework with a focus on simplicity.

## 🚀 Getting Started

### Option 1: Running with Docker and Laravel Sail

If you have Docker installed on your system, you can use Laravel Sail to easily set up and run the project.

1. **Clone the repository**:
   ```bash
   git clone https://github.com/mr-mokhtari/task-management-system.git
   cd task-management-system
   ```

2. **Install dependencies**:
   ```bash
   docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
   ```
   For more details, please refer to the [Laravel Sail documentation](https://laravel.com/docs/11.x/sail#installing-composer-dependencies-for-existing-projects).


3. **Set up your environment variables**:
   Copy `.env.example` to `.env` and configure your database, Redis, and other necessary settings.
   ```bash
   cp .env.example .env
   ```

You should open the `.env` file and set the following values to ensure compatibility with Sail's Docker services:

```env
QUEUE_CONNECTION=redis

REDIS_HOST=redis

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

Adjust these settings as needed according to your policies or requirements.
4. **Start the Docker containers**:
   ```bash
   ./vendor/bin/sail up -d
   ```

5. **Generate the application key**:
    ```bash
   ./vendor/bin/sail artisan key:generate
   ```

6. **Run migrations and seed the database**:
   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```

7. **Compile the frontend assets**:
   ```bash
   ./vendor/bin/sail npm install
   ./vendor/bin/sail npm run dev
   ```

8. **Access the application**:
   Open your browser and navigate to [http://localhost](http://localhost)

### Option 2: Running without Docker

If you do not have Docker installed but have PHP, MySQL, and Node.js set up on your system, you can run the project manually.

1. **Clone the repository**:
   ```bash
   git clone https://github.com/mr-mokhtari/task-management-system.git
   cd task-management-system
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Set up your environment variables**:
   Copy `.env.example` to `.env` and configure your database, Redis, and other necessary settings.
   ```bash
   cp .env.example .env
   ```

4. **Create a database**:
   Create a new database in your MySQL server and update the `.env` file with your database credentials.

5. **Generate the application key**:
   ```bash
   ./vendor/bin/sail artisan key:generate
   ```
   
6. **Run migrations and seed the database**:
   ```bash
   php artisan migrate --seed
   ```

7. **Compile the frontend assets**:
   ```bash
   npm install
   npm run dev
   ```

8. **Serve the application**:
   ```bash
   php artisan serve
   ```
   Now, open your browser and navigate to [http://localhost](http://localhost)

## 🧪 Running Tests

To ensure everything is working as expected, you can run the project's tests. Here’s how you can do it depending on your setup:

### With Docker and Sail

1. **Run the tests**:
   ```bash
   ./vendor/bin/sail artisan test
   ```

### Without Docker

1. **Run the tests**:
   ```bash
   php artisan test
   ```

## 🎉 Conclusion

Congratulations! You’ve successfully set up and run the **Task Management System**. Whether you chose to use Docker or not, the application should now be up and running. If you encounter any issues or have any questions, don’t hesitate to reach out.
