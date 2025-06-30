# Laravel Dockerized Application

This is a full-stack web application built with Laravel, Vite, and Tailwind CSS, all running in a containerized environment powered by Docker and Docker Compose. It includes a complete setup for local development, including a web server, database, and other necessary services.

## Features

- **Backend:** Laravel 11 with PHP 8.2
- **Frontend:** Vite, Tailwind CSS, Alpine.js, and daisyUI
- **Database:** Microsoft SQL Server
- **Development Environment:** Fully containerized with Docker and Docker Compose.
- **Services:** Includes a web server (Nginx), a database (SQL Server), and Adminer for database management.
- **Authentication:** Comes with Laravel Breeze for ready-to-use authentication scaffolding.
- **Testing:** Set up with Pest for a modern and expressive testing experience.
- **PDF Generation:** Includes `barryvdh/laravel-dompdf` for easy PDF generation from HTML.
- **Eloquent Models:** Uses `reliese/laravel` to generate Eloquent models automatically.

## Prerequisites

Before you begin, ensure you have the following installed on your local machine:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started

Follow these steps to get the project up and running on your local machine.

### 1. Clone the Repository

First, clone this repository to your local machine:

```bash
git clone <repository-url>
cd <repository-directory>
```

### 2. Set Up the Environment File

The project uses a `.env` file for environment-specific configurations. You can create one by copying the example file:

```bash
cp .env.sample .env
```

Next, open the `.env` file and customize the variables as needed. At a minimum, you should set the following:

- `PROJECT_NAME`: A unique name for your project.
- `PROJECT_BASE_URL`: The base URL for your project (e.g., `my-project.localhost`).
- `DB_PASSWORD`: A strong password for the database.

### 3. Build and Run the Docker Containers

With Docker and Docker Compose installed, you can build and run the containers with a single command:

```bash
docker-compose up -d --build
```

This will start all the services in the background.

### 4. Install Dependencies

Once the containers are running, you need to install the PHP and Node.js dependencies:

```bash
docker-compose exec app composer install
docker-compose exec app npm install
```

### 5. Run Database Migrations

Finally, run the database migrations to set up the necessary tables:

```bash
docker-compose exec app php artisan migrate
```

## Usage

### Running the Development Server

To start the Vite development server, run the following command:

```bash
docker-compose exec app npm run dev
```

The application will be available at the `PROJECT_BASE_URL` you set in your `.env` file.

### Running Tests

To run the test suite, use the following command:

```bash
docker-compose exec app php artisan test
```

## Creating and Restoring a Database

To create a new database and import data from a `.sql` backup file, follow these steps carefully.

**Important:** All `docker-compose` commands must be run from your host machine's terminal, in the same directory as the `docker-compose.yml` file.

1.  **Configure Environment:** Ensure your `.env` file has the correct values for `DB_DATABASE` (e.g., `ekne`) and `DB_PASSWORD`.

2.  **Place the SQL file:** Copy your `.sql` backup file (e.g., `backup.sql`) into the `app/` directory.

3.  **(Debugging) Verify Password:** The "Login failed" error usually means the password is wrong. Run this command to see the password that the container is using. It should match what's in your `.env` file.

    ```bash
    docker-compose exec sqlsrv /bin/bash -c 'echo "Container SA_PASSWORD is: ${SA_PASSWORD}"'
    ```
    If this is incorrect, check your `.env` file, then **restart the containers** for the changes to take effect:
    ```bash
    docker-compose down && docker-compose up -d
    ```

4.  **Create the Database:** If the database does not already exist, create it with this command. It connects to the `master` database to run the `CREATE DATABASE` query.

    ```bash
    docker-compose exec sqlsrv /bin/bash -c '/opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -P "${SA_PASSWORD}" -Q "CREATE DATABASE ${DB_DATABASE}" -N -C'
    ```
    If this command succeeds, you can proceed. If it fails with a login error, the password is the problem.

5.  **Run the Import Command:** Once the database exists, import your data into it.

    ```bash
    docker-compose exec sqlsrv /bin/bash -c '/opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -P "${SA_PASSWORD}" -d "${DB_DATABASE}" -i /var/www/backup.sql -N -C'
    ```

## Working with the Database

Here are some useful commands for managing the database directly from your host machine.

### Drop the Database

To delete the existing database, run:

```bash
/opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -P agelos@L1nux -Q "drop DATABASE ekne" -N -C
```

### Create the Database

To create a new, empty database, use:

```bash
/opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -P agelos@L1nux -Q "CREATE DATABASE ekne" -N -C
```

### Import a SQL File

To import data from a `.sql` file into the database, run:

```bash
docker-compose exec sqlsrv /bin/bash -c '/opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -P "agelos@L1nux" -d "ekne" -i /var/www/backup.sql -N -C'
```

## Built With

- [Laravel](https://laravel.com/) - The web framework used
- [Vite](https://vitejs.dev/) - The frontend build tool
- [Tailwind CSS](https://tailwindcss.com/) - The CSS framework
- [Alpine.js](https://alpinejs.dev/) - The JavaScript framework
- [Docker](https://www.docker.com/) - The containerization platform
- [Pest](https://pestphp.com/) - The PHP testing framework
