# l5 repository bug
If an array $attributes exists in the model, its data is written to the table when the repository is updated

## Deployment
Composer
 ```
~$ composer install
```

Copy that example file as our main .env file with this command:
 ```
~$ cp .env.example .env
```
Key generate
```
~$ php artisan key:generate
```
Edit that new .env file (required variables):
 ```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

```
Migrations
```
~$ php artisan migrate
```
Running a test that shows a bug
```
~$ ./vendor/bin/phpunit
```

