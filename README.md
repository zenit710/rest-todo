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
5. Run `php bin/console server:run`
6. API is available on address: `http://127.0.0.1:8000`

## Categories

You can create, read, update and delete categories. To do that you have to:

* create by sending `POST` request to `/categories` with name in body
* read by sending `GET` request to `/categories/{id}`
* update by sending `PUT` request to `/categories/{id}` with name in body
* delete by sending `DELETE` request to `/categories/{id}`

Name should be string.

## Tasks

You can create, read, update and delete tasks. You can also set task as done or as to do.

* create by sending `POST` request to `/tasks` with name, categoryId and dueDate in body
* read by sending `GET` request to `/tasks/{id}`
* update by sending `PUT` request to `/tasks/{id}` with name, categoryId, dueDate and status in body
* delete by sending `DELETE` request to `/tasks/{id}`
* mark as done/to do by sending `PATCH` request to `/tasks/{id}` with status in body;

Parameters type should be as below:

* name - string
* categoryId - int
* dueDate - DateTime
* status - boolean