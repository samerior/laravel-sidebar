## Create Sidebar Extender

If you are working in a Module based directory structure, you might want to set the specific sidebar items in their own folder. This is possibly by using sidebar extenders:

```php
use Samerior\LaravelSidebar\Contracts\SidebarExtender;

class YourModuleSidebarExtender implements SidebarExtender 
{
    public function extendWith(Menu $menu)
    {
        $menu->group('Your Module');

        return $menu;
    }
}
```

## Register Extender
You can easily register these extenders in your custom Sidebar class:

```php
class YourSidebar implements Sidebar
{
    public function build()
    {
        $extender = new YourModuleSidebarExtender; 

        $this->menu->add(
            $extender->extendWith($this->menu)
        );
    }
}
```
