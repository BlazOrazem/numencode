# Numencode - Content Management System

[![Total Downloads](https://img.shields.io/packagist/dt/numencode/cms?label=Downloads&style=flat-square&cacheSeconds=600)](https://packagist.org/packages/numencode/cms) 
[![GitHub issues](https://img.shields.io/github/issues/BlazOrazem/numencode?label=Issues&style=flat-square)](https://github.com/BlazOrazem/numencode/issues) 
[![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/BlazOrazem/numencode?label=Release&style=flat-square&cacheSeconds=600)](https://github.com/BlazOrazem/numencode)
[![MIT License](https://img.shields.io/github/license/BlazOrazem/numencode?label=License&color=blue&style=flat-square&cacheSeconds=600)](https://github.com/BlazOrazem/numencode/blob/master/LICENSE)

**Numencode** is a web application, based on Laravel framework 6.4, that allows publishing, editing and modifying 
content, organizing, deleting as well as maintenance from a central interface.

It is used to run websites containing pages, blog, news, galleries, catalogs and shopping.

**Numencode** is a stand-alone application to create, deploy, manage and store content on web pages. 
Web content includes text and embedded graphics, photos, video, audio and code (e.g., for applications) 
that displays content or interacts with the user.

**Numencode** contains built-in back-office administration panel for managing content and structure on a specific website.

# Official Documentation

Documentation for the **Numencode** is currently under development.

# About the Author

**Numencode** was created by and is maintained by [Blaz Orazem](https://www.orazem.si/).

Please write an email to [info@numencode.com](mailto:info@numencode.com) about all the things concerning this project.

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

Check file `.env.example` for more configurations and copy desired settings to your `.env` file.

Be sure to check `/config/numencode.php` file for some more application settings.

# Admin Dashboard

The URL for the admin dashboard should be your `APP_URL` (from `.env` file) followed by `/admin`, 
eg.: `https://www.numencode.com/admin`

The manager credentials are set by the `php artisan project:install` command.

# Website frontend workflow with Laravel Mix for the default theme

Install [Node.js](https://nodejs.org/) on your system to be able to run `npm` commands in your terminal.

Install dependency manager [Yarn](https://yarnpkg.com/) by running command:
```bash
$ npm i -g yarn
```

Go to your project root folder and install dependencies with Yarn:
```bash
$ yarn install
```

Resources for the default theme (styles and scripts) are stored in:
~~~
/modules/Cms/Resources/assets/
~~~

After you make modifications in styles and/or scripts files, simply run Laravel Mix:

Development mode (non-minified code with source maps):
```bash
$ yarn run dev
```

Production mode (minified code):
```bash
$ yarn run prod
```

Watch mode (runs in the background and watches files for changes):
```bash
$ yarn run watch
```

# Admin frontend workflow with Laravel Mix for the admin theme

Install [Node.js](https://nodejs.org/) on your system to be able to run `npm` commands in your terminal.

Install dependency manager [Yarn](https://yarnpkg.com/) by running command:
```bash
$ npm i -g yarn
```

From the project root directory navigate to:
```bash
$ cd modules/Admin/Resources/assets/vendor
```

Install dependencies with Yarn:
```bash
$ yarn install
```

Resources for the admin theme (styles and scripts) are stored in:
~~~
/modules/Admin/Resources/assets/
~~~

After you make modifications in styles and/or scripts run in directory `modules/Admin/Resources/assets`,
run Laravel Mix with the command:

Development mode (non-minified code with source maps):
```bash
$ yarn run dev
```

Production mode (minified code):
```bash
$ yarn run prod
```

Watch mode (runs in the background and watches files for changes):
```bash
$ yarn run watch
```

# License

Numencode is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

[![MIT License](https://img.shields.io/github/license/BlazOrazem/numencode?label=License&color=blue&style=flat-square&cacheSeconds=600)](https://github.com/BlazOrazem/numencode/blob/master/LICENSE)
