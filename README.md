# coding-challenge

## Prerequisites:
- PHP 8.1 or above
- Composer
- NodeJS
- MySQL server ( I used xampp )
- Redis server

## Getting started

``` bash
git clone https://github.com/TarikDorhmi/coding-challenge.git
```

``` bash
cd coding-challenge/laravel-cc
```

## Setup Environment
``` bash
composer install
```

``` bash
php artisan key:generate
```

``` bash
php artisan migrate --seed
```

``` bash
npm install
```

``` bash
npm run dev
```

``` bash
php artisan serve
```

### Run this command to create a new product from cli :
``` bash
php artisan product:create {name} {description} {price}
```

### Implement a command to seed the DB with 1k categories and 1M products
``` bash
php artisan db:seed-custom
```

### Run this command for testing:
``` bash
php artisan test
```