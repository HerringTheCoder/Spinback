# Spinback

![Spinback](public/images/spinback-300.png)

A web system used for management of multiple local departments of a company dealing with second-hand music discs

## Requirements

-   php >=7.1
-   composer
-   mysql
-   node/npm

All the requirements above are met by [Laragon](https://laragon.org), local development environment software

## Installation

Clone the repository and navigate into the source code folder

```
git clone https://github.com/HerringTheCoder/Spinback.git
cd Spinback
```

Install required dependencies

```
composer install
npm install
```

Copy the contents of `.env.example` into `.env` file and configure the environment (e.g. database connection)

```
cp .env.example .env
```

Generate the application key, run database migrations

```
php artisan key:generate
php artisan migrate
```

You can also populate the database with example data

```
php artisan db:seed
```

If you don't want to populate the whole database, you may need to at least seed default policies

```
php artisan db:seed --class=BouncerSeeder
```

Compile assets

```
npm run dev
```

Create symbolic link for public storage disk

```
php artisan storage:link
```

### Production

In order to run Spinback in production mode, change following lines in .env file

```
APP_ENV=production
APP_DEBUG=false
APP_URL=...
```

Create optimized and minified assets

```
npm run prod
```

Configure mail environment variables. You can use services like [SendGrid](https://sendgrid.com/)

### Startup

For development purposes either use web server provided by [Laragon](https://laragon.org), or built-in one:

```
php artisan serve
```

Watch changes in assets by running:

```
npm run watch
```
