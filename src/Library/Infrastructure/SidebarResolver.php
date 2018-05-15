<?php

namespace Samerior\LaravelSidebar\Infrastructure;

use Samerior\LaravelSidebar\Contracts\Sidebar;

/**
 * Interface SidebarResolver
 * @package Samerior\LaravelSidebar\Infrastructure
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
