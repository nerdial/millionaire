

## Features
1. Login
2. Register
3. Top 10 user table
4. Personal stat for each user
5. Creating new question and option only by admin


## How to set up the project

```console
composer install
```

## If you want dummy stats, user, game and questions:

```console
php artisan migrate --seed
```

## Otherwise, run only migrations

```console
php artisan migrate
```
