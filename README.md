## Installation

```
composer require kilroyweb/coordinates
```

Add to config.php -> providers:

```
KilroyWeb\Coordinates\Providers\CoordinatesServiceProvider::class,
```

Migrate the coordinates table:

```
php artisan migrate
```

Seed the coordinates table

```
php artisan db:seed --class="KilroyWeb\Coordinates\Seeds\CoordinatesTableSeeder"
```