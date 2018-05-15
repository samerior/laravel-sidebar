<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Traits;

use Samerior\LaravelSidebar\Contracts\Item;

/**
 * Trait ItemableTrait
 * @package Samerior\LaravelSidebar\Traits
 */
trait ItemableTrait
{
    /**
     * @var Collection|Item[]
     */
    protected $items;

    /**
     * Add a new Item (or edit an existing item) to the Group
     *
     * @param string $name
     *
     * @param \Closure|null $callback
     * @return Item
     */
    public function item($name, \Closure $callback = null)
    {
        if ($this->items->has($name)) {
            $item = $this->items->get($name);
        } else {
            $item = $this->container->make(Item::class);
            $item->name($name);
        }

        $this->call($callback, $item);

        $this->addItem($item);

        return $item;
    }

    /**
     * Add Item instance to Group
     *
     * @param Item $item
     * @return ItemableTrait
     */
    public function addItem(Item $item)
    {
        $this->items->put($item->getName(), $item);

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection|Item[]
     */
    public function getItems()
    {
        return $this->items->sortBy(function (Item $item) {
            return $item->getWeight();
        });
    }

    /**
     * Check if we have items
     * @return bool
     */
    public function hasItems(): bool
    {
        return \count($this->items) > 0;
    }
}
