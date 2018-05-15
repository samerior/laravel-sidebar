<?php

namespace Samerior\LaravelSidebar\Tests\Core;

use Mockery as m;
use Illuminate\Contracts\Container\Container;
use Samerior\LaravelSidebar\Contracts\Group;
use Samerior\LaravelSidebar\Library\Core\DefaultGroup;
use Illuminate\Support\Collection;
use Samerior\LaravelSidebar\Library\Core\DefaultItem;

class DefaultGroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * @var DefaultGroup
     */
    protected $group;

    protected function setUp()
    {
        $this->container = m::mock(Container::class);
        $this->group     = new DefaultGroup($this->container);
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

        $serialized   = serialize($this->group);
        $unserialized = unserialize($serialized);

        $this->assertInstanceOf(Group::class, $unserialized);
        $this->assertInstanceOf(Collection::class, $unserialized->getItems());

        $this->assertCount(1, $unserialized->getItems());
    }
}

class StubGroup extends DefaultGroup
{
}
