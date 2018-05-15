<?php

namespace Samerior\LaravelSidebar\Tests\Core;


use Illuminate\Support\Collection;
use Samerior\LaravelSidebar\Contracts\Group;
use Samerior\LaravelSidebar\Contracts\Menu;
use Samerior\LaravelSidebar\Library\Core\DefaultGroup;
use Samerior\LaravelSidebar\Library\Core\DefaultMenu;
use Samerior\LaravelSidebar\Tests\SidebarTestCase;
use Samerior\LaravelSidebar\Tests\Stubs\StubMenu;

class DefaultMenuTest extends SidebarTestCase
{
    /**
     * @var DefaultMenu
     */
    protected $menu;

    protected function setUp()
    {
        $this->setContainer();
        $this->menu = new DefaultMenu($this->container);
    }

    /** @test */
    public function can_instantiate_new_menu()
    {
        $menu = new DefaultMenu($this->container);
        $this->assertInstanceOf(Menu::class, $menu);
    }

    /** @test */
    public function can_have_custom_menus()
    {
        $menu = new StubMenu($this->container);

        $this->assertInstanceOf(Menu::class, $menu);
    }

    public function test_menu_can_be_cached()
    {
        $this->mockContainerMake();
        $this->menu->group('test');
        $this->menu->group('test2');

        $serialized = serialize($this->menu);
        $unserialized = unserialize($serialized);

        $this->assertInstanceOf(Menu::class, $unserialized);
        $this->assertInstanceOf(Collection::class, $unserialized->getGroups());
        $this->assertCount(2, $unserialized->getGroups());
    }

    public function test_can_add_group_instance_to_menu()
    {
        $group = new DefaultGroup($this->container);
        $group->name('test');

        $this->menu->addGroup($group);

        $this->assertInstanceOf(Collection::class, $this->menu->getGroups());
        $this->assertCount(1, $this->menu->getGroups());
        $this->assertEquals('test', $this->menu->getGroups()->first()->getName());
    }

    public function test_can_add_group_to_menu()
    {
        $this->mockContainerMake();

        $this->menu->group('test');

        $this->assertInstanceOf(Collection::class, $this->menu->getGroups());
        $this->assertCount(1, $this->menu->getGroups());
    }

    public function test_can_add_existing_group_to_menu_wont_duplicate()
    {
        $this->mockContainerMake('test');

        $this->menu->group('test');
        $this->menu->group('test');
        $this->menu->group('test');

        $this->assertInstanceOf(Collection::class, $this->menu->getGroups());
        $this->assertCount(1, $this->menu->getGroups());
    }

    public function test_get_groups_returns_sorted_groups()
    {
        $group = new DefaultGroup($this->container);
        $group->name('secondItem');
        $group->weight(2);

        $this->menu->addGroup($group);

        $group = new DefaultGroup($this->container);
        $group->name('firstItem');
        $group->weight(1);

        $this->menu->addGroup($group);

        $this->assertInstanceOf(Collection::class, $this->menu->getGroups());
        $this->assertCount(2, $this->menu->getGroups());

        $this->assertEquals('firstItem', $this->menu->getGroups()->first()->getName());
    }

    public function test_can_combined_menu_instances()
    {
        // Add group to original menu
        $group = new DefaultGroup($this->container);
        $group->name('existing');
        $group->weight(2);
        $this->menu->addGroup($group);

        // Init new menu
        $menu = new DefaultMenu($this->container);

        // Add a new one
        $group = new DefaultGroup($this->container);
        $group->name('new menu group');
        $group->weight(1);
        $menu->addGroup($group);

        // Append to existing
        $group = new DefaultGroup($this->container);
        $group->name('existing');
        $group->weight(2);
        $menu->addGroup($group);

        $this->menu->add($menu);

        $this->assertInstanceOf(Collection::class, $this->menu->getGroups());
        $this->assertCount(2, $this->menu->getGroups());

        $this->assertEquals('new menu group', $this->menu->getGroups()->first()->getName());
    }

    protected function mockContainerMake($name = null, $weight = null)
    {
        $mock = app(Group::class);
        $mock->shouldReceive('name');
        $mock->shouldReceive('getName')->andReturn($name);
        $mock->shouldReceive('getWeight')->andReturn($weight);

        $this->container->shouldReceive('make')->with(Group::class)->andReturn(
            $mock
        );

        return $mock;
    }
}

