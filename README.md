# Lucky Draw System

A simple lucky draw system

## Getting Started

### Prerequisites

What things you need to install the software and how to install them

```
- web server
```

### Installation

#### Dependencies
```
composer install
npm install
```
#### Configuration
Rename `.env.example` file to `.env` and modify the following entries depending on your server configuration
```
APP_URL=<app_url>
DB_HOST=<host>
DB_PORT=<mysql_port>
DB_DATABASE=luckydraw_db

# Use "homestead" if you are using vagrant box
DB_USERNAME=<db_username>

# Use "secret" if you are using vagrant box
DB_PASSWORD=<password>
```

#### Database (MySQL)
```
CREATE DATABASE luckydraw_db
```

Run `php artisan serve` or create a virtual host and point to `/public` directory or run through vagrant box:
```
# Add to your hosts file
192.168.10.20  homestead.test

# then run
vagrant up
```

Run the migrations
```
# if you are using vagrant box
vagrant ssh
cd code/luckydraw

# without test data
php artisan migrate

# or with test data
php artisan migrate --seed
```

## Running the tests

To test that the system was installed properly

```
phpunit
```
## Built With

* [Laravel 7](http://laravel.com/docs/7.x) - The web framework used

## Authors

* **Medard Mandane**
