# Numencode - Content Management System

**Numencode** is a web application, based on Laravel framework 5.4, that allows publishing, editing and modifying 
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

**Numencode** was created by and is maintained by [Blaz Orazem](http://www.orazem.si/).
Follow [@blazorazem](https://twitter.com/blazorazem) on Twitter.

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

## Frontend workflow with Laravel Mix

1. Install [Node.js](https://nodejs.org/) on your system.
2. Install dependencies with [npm](https://www.npmjs.com/):
```bash
$ npm install
```
3. Alternatively you can install dependencies with [Yarn](https://yarnpkg.com/):
```bash
$ npm install --global yarn
$ yarn install
```
4. Resources for the default theme (styles and scripts) are stored in:
~~~
/modules/Cms/Resources/assets/
~~~
5. After the changes in styles and/or scripts run Laravel Mix:

Development mode (non-minified code):
```bash
$ npm run dev
```
Production mode (minified code):
```bash
$ npm run production
```
Watch mode (runs in the background and watches files for changes):
```bash
$ npm run watch
```

## Demo credentials

**Back-office:** should be your APP_URL (in .env file) followed by /admin, eg.: http://www.numencode.app/admin
**Username:** info@numencode.com
**Password:** q1w2e3

## License

The Numencode is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

[<img src="https://img.shields.io/packagist/l/doctrine/orm.svg?style=flat-square" alt="MIT License">](LICENSE)
