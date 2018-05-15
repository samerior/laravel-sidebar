<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Contracts;

/**
 * Interface SidebarFlusher
 * @package Samerior\LaravelSidebar\Contracts
 */
interface SidebarFlusher
{
    /**
     * Flush
     *
     * @param $name
     */
    public function flush($name);
}
