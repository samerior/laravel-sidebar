<?php

namespace Samerior\LaravelSidebar\Tests\Core;

use Illuminate\Support\Collection;
use Mockery as m;
use Samerior\LaravelSidebar\Contracts\Append;
use Samerior\LaravelSidebar\Contracts\Badge;
use Samerior\LaravelSidebar\Contracts\Item;
use Samerior\LaravelSidebar\Library\Core\DefaultAppend;
use Samerior\LaravelSidebar\Library\Core\DefaultBadge;
use Samerior\LaravelSidebar\Library\Core\DefaultItem;
use Samerior\LaravelSidebar\Tests\SidebarTestCase;
use Samerior\LaravelSidebar\Tests\Stubs\StubItem;

/**
 * Class DefaultItemTest
 * @package Samerior\LaravelSidebar\Tests\Core
 */
class DefaultItemTest extends SidebarTestCase
{
    /**
     * @var DefaultItem
     */
    protected $item;

    protected function setUp()
    {
        $this->setContainer();
        $this->item = new DefaultItem($this->container);
    }

    public function test_can_instantiate_new_item()
    {
        $item = new DefaultItem($this->container);

        $this->assertInstanceOf(Item::class, $item);
    }

    public function test_can_have_custom_items()
    {
        $item = new StubItem($this->container);

        $this->assertInstanceOf(Item::class, $item);
    }

    public function test_can_set_name()
    {
        $this->item->name('name');
        $this->assertEquals('name', $this->item->getName());
    }

    public function test_can_set_url()
    {
        $this->item->url('url');
        $this->assertEquals('url', $this->item->getUrl());
    }

    public function test_can_set_icon()
    {
        $this->item->icon('icon');
        $this->assertEquals('icon', $this->item->getIcon());
    }

    public function test_can_set_weight()
    {
        $this->item->weight(1);
        $this->assertEquals(1, $this->item->getWeight());
    }

    public function test_item_can_be_cached()
    {
        $item = new DefaultItem($this->container);
        $this->item->addItem($item);

        $this->item->name('name');
        $this->item->icon('icon');
        $this->item->weight(1);
        $this->item->url('url');

        $serialized = serialize($this->item);
        $unserialized = unserialize($serialized);

        $this->assertInstanceOf(Item::class, $unserialized);
        $this->assertInstanceOf(Collection::class, $unserialized->getItems());
        $this->assertCount(1, $unserialized->getItems());
        $this->assertEquals('name', $unserialized->getName());
        $this->assertEquals('icon', $unserialized->getIcon());
        $this->assertEquals(1, $unserialized->getWeight());
        $this->assertEquals('url', $unserialized->getUrl());
    }

    public function test_can_add_a_badge_instance()
    {
        $badge = new DefaultBadge($this->container);
        $badge->setValue(1);
        $this->item->addBadge($badge);

        $this->assertInstanceOf(Collection::class, $this->item->getBadges());
        $this->assertCount(1, $this->item->getBadges());
        $this->assertEquals('1', $this->item->getBadges()->first()->getValue());
    }

    public function test_can_add_a_badge()
    {
        $mock = $this->mockContainerMakeForBadge();
        $mock->shouldReceive('setValue');
        $mock->shouldReceive('setClass');
        $mock->shouldReceive('getValue')->andReturn(1);
        $mock->shouldReceive('getClass')->andReturn('className');

        $this->item->badge(1, 'className');

        $this->assertInstanceOf(Collection::class, $this->item->getBadges());
        $this->assertCount(1, $this->item->getBadges());
        $this->assertEquals(1, $this->item->getBadges()->first()->getValue());
        $this->assertEquals('className', $this->item->getBadges()->first()->getClass());
    }

    public function test_can_add_a_append_instance()
    {
        $append = new DefaultAppend($this->container);
        $append->url('url');
        $this->item->addAppend($append);

        $this->assertInstanceOf(Collection::class, $this->item->getAppends());
        $this->assertCount(1, $this->item->getAppends());
        $this->assertEquals('url', $this->item->getAppends()->first()->getUrl());
    }

    public function test_can_add_a_append()
    {
        $mock = $this->mockContainerMakeForAppend();
        $mock->shouldReceive('route');
        $mock->shouldReceive('icon');
        $mock->shouldReceive('name');
        $mock->shouldReceive('getUrl')->andReturn('url');
        $mock->shouldReceive('getIcon')->andReturn('icon');
        $mock->shouldReceive('getName')->andReturn('name');

        $this->item->append('route', 'icon', 'name');

        $this->assertInstanceOf(Collection::class, $this->item->getAppends());
        $this->assertCount(1, $this->item->getAppends());
        $this->assertEquals('url', $this->item->getAppends()->first()->getUrl());
        $this->assertEquals('icon', $this->item->getAppends()->first()->getIcon());
        $this->assertEquals('name', $this->item->getAppends()->first()->getName());
    }

    protected function mockContainerMakeForBadge()
    {
        $mock = m::mock(Badge::class);

        $this->container->shouldReceive('make')->with(Badge::class)->andReturn(
            $mock
        );

        return $mock;
    }

    protected function mockContainerMakeForAppend()
    {
        $mock = m::mock(Append::class);

        $this->container->shouldReceive('make')->with(Append::class)->andReturn(
            $mock
        );

        return $mock;
    }
}
