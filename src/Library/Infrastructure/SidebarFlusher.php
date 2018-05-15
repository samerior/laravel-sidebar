<?php

namespace Samerior\LaravelSidebar\Infrastructure;
/**
 * Interface SidebarFlusher
 * @package Samerior\LaravelSidebar\Infrastructure
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
