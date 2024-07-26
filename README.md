### video

Bookmarking for videos.

#### Installation

Run following commands:

```
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Migrate database:

```
php artisan migrate --seed
```

To try this app, run these commands on seperate terminal:

```
npm run dev
php artisan serve
```

Sign in with email `admin@example.com` and password `password`.