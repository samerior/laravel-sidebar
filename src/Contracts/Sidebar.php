<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Contracts;

/**
 * Interface Sidebar
 * @package Samerior\LaravelSidebar\Contracts
 */
interface Sidebar
{
    /**
     * Build your sidebar implementation here
     */
    public function build();

    /**
     * @return Menu
     */
    public function getMenu(): Menu;
}
