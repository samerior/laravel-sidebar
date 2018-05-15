<?php

namespace Samerior\LaravelSidebar\Tests\Traits;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Collection;
use Samerior\LaravelSidebar\Contracts\Item;
use Samerior\LaravelSidebar\Contracts\Itemable;
use Samerior\LaravelSidebar\Library\Core\DefaultItem;
use Samerior\LaravelSidebar\Traits\CallableTrait;
use Samerior\LaravelSidebar\Traits\ItemableTrait;

class ItemableTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var StubItemableClass
     */
    protected $itemable;

    protected function setUp()
    {
        $this->container = \Mockery::mock(Container::class);
        $this->itemable = new StubItemableClass($this->container);
    }

    public function test_can_add_an_item_instance()
    {
        $item = new DefaultItem($this->container);
        $item->name('itemName');
        $this->itemable->addItem($item);

        $this->assertInstanceOf(Collection::class, $this->itemable->getItems());
        $this->assertCount(1, $this->itemable->getItems());
        $this->assertEquals('itemName', $this->itemable->getItems()->first()->getName());
    }

    public function test_can_add_an_item()
    {
        $this->mockContainerMake('itemName');
        $this->itemable->item('itemName');

        $this->assertInstanceOf(Collection::class, $this->itemable->getItems());
        $this->assertCount(1, $this->itemable->getItems());
        $this->assertEquals('itemName', $this->itemable->getItems()->first()->getName());
    }

    public function test_can_check_if_has_items()
    {
        $this->assertFalse($this->itemable->hasItems());

        $item = new DefaultItem($this->container);
        $this->itemable->addItem($item);

        $this->assertTrue($this->itemable->hasItems());
    }

    public function test_get_items_sorts_items_by_weight()
    {
        $item = new DefaultItem($this->container);
        $item->name('second item');
        $item->weight(2);
        $this->itemable->addItem($item);

        $item = new DefaultItem($this->container);
        $this->itemable->addItem($item);
        $item->name('first item');
        $item->weight(1);

        $this->assertCount(2, $this->itemable->getItems());
        $this->assertEquals('first item', $this->itemable->getItems()->first()->getName());
    }

    protected function mockContainerMake($name = null, $weight = null)
    {
        $mock = \Mockery::mock(Item::class);
        $mock->shouldReceive('name');
        $mock->shouldReceive('getName')->andReturn($name);
        $mock->shouldReceive('getWeight')->andReturn($weight);

        $this->container->shouldReceive('make')->with(Item::class)->andReturn(
            $mock
        );

        return $mock;
    }
}

class StubItemableClass implements Itemable
{
    use ItemableTrait, CallableTrait;

    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->items = new Collection();
    }
}