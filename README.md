# SIMS-backend

## How to create modules
To create a module, you need to ensure this structure:

```
app/
├─ Modules/
│  ├─ NewModule/
│  │  ├─ Controllers/
│  │  │  └─NewModuleController.php
│  │  ├─ Models/
│  │  │  └─NewModule.php
│  │  ├─ Providers
│  │  │  └─NewModuleProvider.php
│  │  ├─ Services/
│  │  ├─ Migrations/
│  │  └─ routes.php
│  └─ Tickets/
├─ Http/
│  └─ Controllers/      # generic controllers
└─ Providers/           # register modules and services
```
The we need to put the path to composer.json:

"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Modules\\NewModule\\": "app/Modules/NewModule"
    }
},


Then Create the provider to register the module autmoactly

```php
// app/Modules/User/Providers/UserServiceProvider.php
namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        // puedes bindear Services aquí
        // $this->app->bind(UserService::class, fn() => new UserService());
    }

    public function boot()
    {
        // cargar rutas
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }
}
```
Then put the provider in the provider list [app.php](config/app.php)
