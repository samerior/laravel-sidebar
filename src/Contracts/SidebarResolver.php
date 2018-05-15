<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Contracts;

/**
 * Interface SidebarResolver
 * @package Samerior\LaravelSidebar\Contracts
 *
 */
interface SidebarResolver
{
    /**
     * @param string $name
     *
     * @return Sidebar
     */
    public function resolve($name);
}
