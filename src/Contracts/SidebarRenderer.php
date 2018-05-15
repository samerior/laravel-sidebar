<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Contracts;

/**
 * Interface SidebarRenderer
 * @package Samerior\LaravelSidebar\Contracts
 */
interface SidebarRenderer
{
    /**
     * @param Sidebar $sidebar
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(Sidebar $sidebar);
}
