<?php

namespace Samerior\LaravelSidebar\Infrastructure;

use Samerior\LaravelSidebar\Contracts\SidebarFlusher;

/**
 * Class NullSidebarFlusher
 * @package Samerior\LaravelSidebar\Infrastructure
 */
class NullSidebarFlusher implements SidebarFlusher
{
    /**
     * Flush
     *
     * @param $name
     */
    public function flush($name)
    {
    }
}
