## Boot and run

1. `composer install`
   Composer version 2.1.4
   Php version 8.0.0
2. `npm i`
   Node version 16.13.1
   Npm version 8.1.2
3. Rename `env.example` to `.env`
   Indicate your DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD
4. `php artisan key:generate`
5. ```php artisan migrate```
6. `php artisan db:seed --class=FeedSeeder`
7. `npm run watch`
8. `php artisan serve`

Open the URL in the browser:
`http://127.0.0.1:8000`
