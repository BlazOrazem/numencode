# Numencode - Content Management System

**Numencode** is a web application, based on Laravel framework 5.3, that allows publishing, editing and modifying 
content, organizing, deleting as well as maintenance from a central interface.

It is used to run websites containing pages, blogs, news, galleries, catalogs and shopping.

**Numencode** is a stand-alone application to create, deploy, manage and store content on web pages. 
Web content includes text and embedded graphics, photos, video, audio and code (e.g., for applications) 
that displays content or interacts with the user.

**Numencode** contains built-in back-office administration panel for managing content and structure on a specific website.

## Official Documentation

Documentation for the **Numencode** can be found on the [Numencode website](http://www.numencode.com/page/docs/).

**The application is still in development mode.**

## About the Author

**Numencode** was created by and is maintained by [Blaz Orazem](https://github.com/BlazOrazem).

## Installation

Create a project directory and initialize a repository
```bash
$ git init
```

Clone this repository to your project directory
```bash
$ git clone https://github.com/BlazOrazem/numencode.git
```

Set up environment configuration 
```bash
$ cp .env.sample .env
```

Edit .env file and enter your credentials for database, etc.
```bash
$ vi .env
```

Set the application key
```bash
$ php artisan key:generate
```

Run database migrations
```bash
$ php artisan migrate
```

Seed the database with records
```bash
$ php artisan db:seed
```

## Demo credentials

**Back-office:** should be your APP_URL (in .env file) followed by /admin, eg.: http://www.numencode.app/admin

**Username:** info@numencode.com

**Password:** q1w2e3

## License

The Numencode is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

[<img src="https://img.shields.io/packagist/l/doctrine/orm.svg?style=flat-square" alt="MIT License">](LICENSE)
