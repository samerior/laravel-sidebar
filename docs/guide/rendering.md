The rendering of your sidebar can be done inside a `View composer` or `View creator`. You can use dependency injection to gain access to the Sidebar class and the `SidebarRenderer`. Simply assign the rendered result to a variable and echo that variable inside the view.

**View creator:**
```php
<?php

namespace App\Composers;


use App\Library\Sidebar\MySidebar;
use Samerior\LaravelSidebar\Contracts\SidebarRenderer;

class SidebarCreator
{

    protected $sidebar;

    /**
     * @var SidebarRenderer
     */
    protected $renderer;

    /**
     * SidebarCreator constructor.
     * @param MySidebar $sidebar
     * @param SidebarRenderer $renderer
     */
    public function __construct(MySidebar $sidebar, SidebarRenderer $renderer)
    {
        $this->sidebar  = $sidebar;
        $this->renderer = $renderer;
    }

    /**
     * @param $view
     */
    public function create($view)
    {
        $view->sidebar = $this->renderer->render(
            $this->sidebar
        );
    }
}

```
Then register the view creator

```php
View::creator(
    'layouts.partials.sidebar',
    App\Composers\SidebarCreator::class
);
```

**sidebar.blade.php:**
```php
{!! $sidebar !!}
```
