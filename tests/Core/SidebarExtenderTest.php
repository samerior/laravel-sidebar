<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Tests\Core;

use Illuminate\Support\Collection;
use Samerior\LaravelSidebar\Contracts\Menu;
use Samerior\LaravelSidebar\Library\Core\DefaultGroup;
use Samerior\LaravelSidebar\Library\Core\DefaultMenu;
use Samerior\LaravelSidebar\Tests\SidebarTestCase;
use Samerior\LaravelSidebar\Tests\Stubs\StubSidebarExtender;

/**
 * @property DefaultMenu menu
 */
class SidebarExtenderTest extends SidebarTestCase
{
    protected function setUp()
    {
        $this->setContainer();
        $this->menu = new DefaultMenu($this->container);
    }

    /** @test */
    public function sidebar_can_be_extended_with_an_extender()
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
