# Resurrection

## requirements
* [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
* [npm](https://nodejs.org/en/download/)
* [gulp](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md)

## setup
* install and set up Homestead (vagrant)
* composer install
* copy `.env.example` to `.env` and adjust
* php artisan key:generate
* php artisan migrate
* npm install
* gulp