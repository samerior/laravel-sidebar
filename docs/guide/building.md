## Quick start

Building a new Sidebar is very easy. You create a new class that implements `Samerior\LaravelSidebar\Contracts\Sidebar` interface. This will force you to have a `build` and `getMenu` method.
## Menu
The menu is the top level class of the sidebar which is an instance of `Samerior\LaravelSidebar\Contracts\Menu`.

The `getMenu` should return the menu instance, which you can inject into the constructor as `Samerior\LaravelSidebar\Contracts\Menu`.



Inside `build` you can add the groups and items. 

```php
<?php
namespace App\Library\Sidebar;


use Samerior\LaravelSidebar\Contracts\Group;
use Samerior\LaravelSidebar\Contracts\Menu;
use Samerior\LaravelSidebar\Contracts\Sidebar;

class MySidebar implements Sidebar
{
    /**
     * @var Menu
     */
    protected $menu;

    /**
     * MySidebar constructor.
     * @param Menu $menu
     */
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Build your sidebar implementation here
     */
    public function build()
    {
        $this->menu->group('Dashboard', function (Group $group) {
            $group->item('Projects');
        });
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


## Groups
```php

  $this->menu->group('Dashboard', function (Group $group) {
            $group->item('Projects');
  });
```
## Items
```php
$group->item('Projects');
```

## Badges

## Appends
