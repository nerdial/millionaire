## For your convenience here is a heroku deployed app

http://cryptic-badlands-96373.herokuapp.com/#/

## Features
2. Login
3. Register
4. Unit tests
5. Top 10 user table
6. Personal stat for each user
7. Start game.
8. Crud for questions and options

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

## If you want an admin user, dummy stats, game and questions:

```console
php artisan migrate --seed
```

####Note: If you want an admin user, make sure you run the seeders first
####Then tries these :

```console
-email : user@email.com
-password : password
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
