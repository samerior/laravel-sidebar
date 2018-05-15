<?php

namespace Samerior\LaravelSidebar\Tests;

use Mockery as m;
use Samerior\LaravelSidebar\Contracts\Menu;
use Samerior\LaravelSidebar\Contracts\SidebarExtender;
use Samerior\LaravelSidebar\Library\Core\DefaultGroup;
use Samerior\LaravelSidebar\Library\Core\DefaultMenu;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Container\Container;

/**
 * Class SidebarExtenderTest
 * @package Samerior\LaravelSidebar\Tests
 */
class SidebarExtenderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var DefaultMenu
     */
    protected $menu;

    protected function setUp()
    {
        $this->container = m::mock(Container::class);
        $this->menu = new DefaultMenu($this->container);
    }

    public function test_a_sidebar_can_be_extended_with_an_extender()
    {
        $group = new DefaultGroup($this->container);
        $group->name('original');
        $this->menu->addGroup($group);

        $extender = new StubSidebarExtender();
        $extender->extendWith($this->menu);

        $this->menu->add(
            $extender->extendWith($this->menu)
        );

        $this->assertInstanceOf(Menu::class, $this->menu);
        $this->assertInstanceOf(Collection::class, $this->menu->getGroups());
        $this->assertCount(2, $this->menu->getGroups());
    }
}

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
