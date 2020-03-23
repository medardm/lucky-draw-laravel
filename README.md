# Lucky Draw System

A simple lucky draw system

## Getting Started

### Prerequisites

What things you need to install the software and how to install them

```
- web server
```

### Installing

Create a virtual host and point to `/public` directory or run through vagrant box
```
192.168.10.20  homestead.test
# then run
vagrant up
```

Run the migrations
```
php artisan migrate:install

php artisan migrate --seed
```

Install npm dependencies
```
npm install
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
