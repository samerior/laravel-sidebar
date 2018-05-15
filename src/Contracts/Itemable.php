<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Contracts;

/**
 * Interface Itemable
 * @package Samerior\LaravelSidebar\Contracts
 */
interface Itemable
{
    /**
     * Add a new Item (or edit an existing item) to the Group
     *
     * @param string $name
     * @param \Closure|null $callback
     * @return Item
     */
    public function item($name, \Closure $callback = null);

    /**
     * Add Item instance to Group
     *
     * @param Item $item
     *
     * @return Item
     */
    public function addItem(Item $item);

    /**
     * @return \Illuminate\Support\Collection|Item[]
     */
    public function getItems();

    /**
     * Check if we have items
     * @return bool
     */
    public function hasItems();
}
