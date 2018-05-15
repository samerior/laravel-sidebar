<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Events;

use Illuminate\Contracts\Container\Container;
use Samerior\LaravelSidebar\Library\SidebarManager;

/**
 * Class FlushesSidebarCache
 * @package Samerior\LaravelSidebar\Events
 */
class FlushesSidebarCache
{
    /**
     * @var SidebarManager
     */
    protected $manager;

    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container      $container
     * @param SidebarManager $manager
     */
    public function __construct(Container $container, SidebarManager $manager)
    {
        $this->manager   = $manager;
        $this->container = $container;
    }

    /**
     * Flush the sidebar cache
     */
    public function handle()
    {
        $this->container->call([
            $this->manager,
            'flush'
        ]);
    }
}
