# REST TODO

It's a simple REST API which allows you to manage your to-do list.

## Installation

1. Run `composer install`
2. Create `.env.local` file in main directory and configure connection with database
    ```
    DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
    ```
3. If provided database not exist run `php bin/console doctrine:database:create`
4. Run `php bin/console doctrine:migrations:migrate` to create needed tables
3. Run `php bin/console server:run`
4. API is available on address: `http://127.0.0.1:8000`