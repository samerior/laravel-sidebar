You can register one (or multiple) sidebar(s) inside your ServiceProvider by calling the `register` method on the `Samerior\LaravelSidebar\Library\SidebarManager`.
```php
<?php

namespace App\Providers;

use App\Library\Sidebar\MySidebar;
use Illuminate\Support\ServiceProvider;
use Samerior\LaravelSidebar\Library\SidebarManager;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @param SidebarManager $manager
     * @return void
     */
    public function boot(SidebarManager $manager)
    {
        $manager->register(MySidebar::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

```
