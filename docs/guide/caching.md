## Introduction

When dealing with a lot of menu items, authorization checks, badges filled by values from the database,... the sidebar can become a little bit heavier. By utilising caching, we can make this process a bit lighter.

## Set up
If you have a static sidebar, which is the same for everybody, you can change the `samerior.sidebar.cache.method` option to `static`. If the sidebar can be different for every logged in user, you should set the config setting to `user-based`.

The class should implement `Samerior\LaravelSidebar\Contracts\ShouldCache` and use the `Samerior\LaravelSidebar\Traits\CacheableTrait` trait.

```php
<?php

namespace App\Library\Sidebar;


use Illuminate\Contracts\Auth\Guard;
use Samerior\LaravelSidebar\Contracts\Menu;
use Samerior\LaravelSidebar\Contracts\ShouldCache;
use Samerior\LaravelSidebar\Contracts\Sidebar;
use Samerior\LaravelSidebar\Traits\CacheableTrait;

class AdministrationSidebar implements Sidebar, ShouldCache
{
    use CacheableTrait;
   /**
   * @var \Illuminate\Contracts\Auth\Authenticatable|null 
   */
  protected $user;

  /**
   * @var Guard 
   */
  protected $guard;

  /**
   * @var Menu 
   */
  protected $menu;


    /**
     * @param Menu $menu
     * @param Guard $guard
     */
    public function __construct(Menu $menu, Guard $guard)
    {
        $this->menu = $menu;
        $this->guard = $guard;
        $this->user = $guard->user();
    }

    /**
     * Build the sidebar
     */
    public function build()
    {
        // Build menu
    }

    /**
     * @return Menu
     */
    public function getMenu(): Menu
    {
        return $this->menu;
    }
}

```

## Flushing the Cache

You can use the `Samerior\LaravelSidebar\Events\FlushesSidebarCache` event handler in your own application to tell the package when it should flush the cache. The event class itself should implement `Samerior\LaravelSidebar\Contracts\ShouldFlushCache`
