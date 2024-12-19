## SETUP PROJECT

-   **Node Version**: 22.11.0
-   **NPM Version**: 8.19.3
-   **PHP Version**: 8.1.0

### Project Installation Guide

Follow the steps below to install and set up the project:

#### 1. Clone the Repository

Start by cloning the project repository from GitLab:

```bash
git clone <URL_GitLab_repository> project_name
cd project_name
```

#### 2. Install PHP Dependencies

Install the PHP dependencies using Composer:

```bash
composer install
```

#### 3. Install Node.js Dependencies

Navigate to the project directory and install the Node.js dependencies. You can use npm or Yarn:

```bash
cd project_name
npm install # Alternatively, use yarn if preferred
```

#### 4. Configure the Environment

Copy the `.env.example` file to `.env` and adjust your configurations, such as database connection details:

```bash
cp .env.example .env
```

#### 5. Generate Application Key

Generate the Laravel application key. This key is used for various cryptographic operations in your Laravel application:

```bash
php artisan key:generate
```

#### 6. Install Passport for API Authentication

Install Passport for API authentication. Passport provides a full OAuth2 server implementation for your Laravel application:

```bash
php artisan passport:install
```

#### 7. Migrate the Database

If your project requires a database, run the migrations to create the necessary tables:

```bash
php artisan migrate
php artisan db:seed # Populate the database with initial role and user data
```

#### 8. Run the Development Server

To run the Laravel development server and Vite development server, open two terminal windows. In the first terminal, run:

```bash
php artisan serve
```

In the second terminal, run:

```bash
npm run dev # Or use yarn dev if preferred
```

After completing these steps, you should be able to access your Laravel application at `http://localhost:8000`, and the assets managed by Vite and Tailwind CSS will work as expected.

Make sure to adapt the above steps based on your project's specific structure and configuration.

#### 9. Logging in as Admin

After setting up the project and running the migrations, you can log in as an admin using the following credentials:

Email: superadmin@email.com
Password: Sup3r@dm|n
These credentials correspond to the super admin account created by the seeder. The user role is set to admin, which grants access to admin-level features of the application.
