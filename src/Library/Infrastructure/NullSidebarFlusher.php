<?php

namespace Samerior\LaravelSidebar\Infrastructure;
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
