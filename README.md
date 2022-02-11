## For your convenience here is a heroku deployed app

http://cryptic-badlands-96373.herokuapp.com/#/

## Features
2. Login
3. Register
4. Unit tests
5. Top 10 user table
6. Personal stat for each user
7. Start game.
8. Crud generator for questions and options (still under development)

## Clone the project and run composer

```console
composer install
```

## Copy the .env.example into .env

```console
cp .env.example .env
```

## Then you need create an application key for laravel

```console
php artisan key:generate
```

## If you want dummy stats, user, game and questions:

```console
php artisan migrate --seed
```

## Otherwise, run only migrations

```console
php artisan migrate
```


## This project also contains unit tests for each api

```console
php artisan test
```


## At the end,  run your webserver by calling : 

```console
php artisan serve
```
