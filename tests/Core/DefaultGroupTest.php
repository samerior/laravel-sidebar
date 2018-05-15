<?php

namespace Samerior\LaravelSidebar\Tests\Core;

use Illuminate\Support\Collection;
use Samerior\LaravelSidebar\Contracts\Group;
use Samerior\LaravelSidebar\Library\Core\DefaultGroup;
use Samerior\LaravelSidebar\Library\Core\DefaultItem;
use Samerior\LaravelSidebar\Tests\SidebarTestCase;
use Samerior\LaravelSidebar\Tests\Stubs\StubGroup;

class DefaultGroupTest extends SidebarTestCase
{

    /**
     * @var DefaultGroup
     */
    protected $group;

    protected function setUp()
    {
        $this->setContainer();
        $this->group = new DefaultGroup($this->container);
    }

    public function test_can_instantiate_new_group()
    {
        $group = new DefaultGroup($this->container);

        $this->assertInstanceOf(Group::class, $group);
    }

    public function test_can_have_custom_groups()
    {
        $group = new StubGroup($this->container);

        $this->assertInstanceOf(Group::class, $group);
    }

    public function test_group_can_be_cached()
    {
        $item = new DefaultItem($this->container);
        $this->group->addItem($item);

        $serialized = serialize($this->group);
        $unserialized = unserialize($serialized);

        $this->assertInstanceOf(Group::class, $unserialized);
        $this->assertInstanceOf(Collection::class, $unserialized->getItems());

        $this->assertCount(1, $unserialized->getItems());
    }
}
