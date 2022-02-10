

## Features
1. Login
2. Register
3. Top 10 user table
4. Personal stat for each user
5. Creating new question and option only by admin

## Once you cloned the project  copy the .env.example into .env

```console
cp .env.example .env
```


## How to set up the project

```console
composer install
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

## At the end  run your webserver by calling : 

```console
php artisan serve
```

