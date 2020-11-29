# Notes


# How to install via Docker (First time install)
## Back-end
1. Set up all the config variables. The dotenv file needs to have the correct MySQL credentials. Here's an example of what it should look like:
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=root
DB_PASSWORD=root
```
2. Install composer dependencies using ```composer install```
3. Build the docker environment ```docker-compose up --build```
4. Log into your server, and use ```php artisan migrate && php artisan db:seed``` to migrate your database

## Front-end
1. Run ```npm install``` inside the root

--

## Reseting migration and seeders locally (do not run on production)
```
php artisan migrate:reset && php artisan migrate && php artisan db:seed
chown -R tyrion:www-data /var/www/html/
chmod -R 777 storage
php artisan passport:install
```
