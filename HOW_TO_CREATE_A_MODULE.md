# SIMS-backend

## How to Create Modules (Modular Architecture)

To implement a modular architecture in Laravel, follow these steps to keep your project organized and scalable:

### 1. Directory Structure

Create the following structure inside `app/Modules/` for each new module:

```bash
app/Modules/
  └── NewModule/
      ├── Controllers/
      │     └── NewModuleController.php
      ├── Models/
      │     └── NewModule.php
      ├── Providers/
      │     └── NewModuleServiceProvider.php
      ├── Database/
      │     ├── Migrations/
      │     │     └── Migration.php
      │     └── Seeders/
      │           └── Seeder.php
      └── Routes/
            └── NewModuleRoutes.php
```

### 2. Update composer.json Autoload

Add your module's namespace to the `autoload` section in `composer.json`:

```json
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Modules\\NewModule\\": "app/Modules/NewModule/"
    }
},
```
After editing, run:
```bash
composer dump-autoload
```

### 3. Create the Module Service Provider

Create a Service Provider for your module, for example:

```php
// app/Modules/NewModule/Providers/NewModuleServiceProvider.php
namespace Modules\NewModule\Providers;

use Illuminate\Support\ServiceProvider;

class NewModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        // You can bind services here
        // $this->app->bind(NewService::class, fn() => new NewService());
    }

    public function boot()
    {
        // Load module routes
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
    }
}
```

### 4. Register the Service Provider

Add your module's Service Provider to the providers list. You can do this in `config/app.php` or in `bootstrap/providers.php` depending on your setup:

```php
// config/app.php
'providers' => [
    App\Providers\AppServiceProvider::class,
    // Other providers...
    Modules\NewModule\Providers\NewModuleServiceProvider::class,
],
```
## Create files

### Migrations & seeders

```bash
php artisan make:migration companies --path=Modules/Companies/Database/Migrations
```
---
