# Numencode - Content Management System

**Numencode** is a web application, based on Laravel framework 5.8, that allows publishing, editing and modifying 
content, organizing, deleting as well as maintenance from a central interface.

It is used to run websites containing pages, blogs, news, galleries, catalogs and shopping.

**Numencode** is a stand-alone application to create, deploy, manage and store content on web pages. 
Web content includes text and embedded graphics, photos, video, audio and code (e.g., for applications) 
that displays content or interacts with the user.

**Numencode** contains built-in back-office administration panel for managing content and structure on a specific website.

# Official Documentation

Documentation for the **Numencode** is currently under development.

# About the Author

**Numencode** was created by and is maintained by [Blaz Orazem](http://www.orazem.si/).

Follow [@blazorazem](https://twitter.com/blazorazem) on Twitter.

# Installation in three steps

Clone this repository to your project directory:
```bash
$ git clone https://github.com/BlazOrazem/numencode.git
```

Make sure you have [Composer](https://getcomposer.org/) installed on your system and run:
```bash
$ composer install
```

And finally run Numencode installer:
```bash
$ php artisan project:install
```

You're done.

# Configuration

Check file .env.example for more configurations and copy desired settings to your .env file.

Be sure to check /config/numencode.php file for some more application settings.

# Admin Dashboard

The URL for the admin dashboard should be your APP_URL (in .env file) followed by /admin, eg.: http://www.numencode.app/admin

The manager credentials are set by the php artisan project:install command.

# Website frontend workflow with Laravel Mix for the default theme

Install [Node.js](https://nodejs.org/) on your system.

Go to your project root folder and install npm dependencies with [npm](https://www.npmjs.com/):
```bash
$ npm install
```

Alternatively you can install dependencies with [Yarn](https://yarnpkg.com/):
```bash
$ npm install --global yarn
$ yarn install
```

Resources for the default theme (styles and scripts) are stored in:
~~~
/modules/Cms/Resources/assets/
~~~

After the changes in styles and/or scripts run Laravel Mix:

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

# Admin frontend workflow with Laravel Mix for the admin theme

Install [Node.js](https://nodejs.org/) on your system.

From the project root directory navigate to:
```bash
$ cd modules/Admin/Resources/assets/vendor
```

Install npm dependencies with [npm](https://www.npmjs.com/) or [Yarn](https://yarnpkg.com/):
```bash
$ npm install
$ yarn install
```

Resources for the admin theme (styles and scripts) are stored in:
~~~
/modules/Admin/Resources/assets/
~~~

After the changes in styles and/or scripts run in directory 'modules/Admin/Resources/assets', run Laravel Mix:

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

# License

The Numencode is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

[<img src="https://img.shields.io/packagist/l/doctrine/orm.svg?style=flat-square" alt="MIT License">](LICENSE)
