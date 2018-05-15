<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Tests\Stubs;

use Illuminate\Contracts\Container\Container;
use Samerior\LaravelSidebar\Contracts\Menu;
use Samerior\LaravelSidebar\Contracts\SidebarExtender;
use Samerior\LaravelSidebar\Library\Core\DefaultGroup;

/**
 * Class StubSidebarExtender
 * @package Samerior\LaravelSidebar\Tests\Stubs
 */
class StubSidebarExtender implements SidebarExtender
{
    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu): Menu
    {
        $container = m::mock(Container::class);

        $group = new DefaultGroup($container);
        $group->name('new from extender');
        $menu->addGroup($group);

        $group = new DefaultGroup($container);
        $group->name('original');
        $menu->addGroup($group);

        return $menu;
    }
}
