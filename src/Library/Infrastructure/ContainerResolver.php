<?php

namespace Samerior\LaravelSidebar\Infrastructure;

use Illuminate\Contracts\Container\Container;
use Samerior\LaravelSidebar\Contracts\Sidebar;
use Samerior\LaravelSidebar\Contracts\SidebarResolver;
use Samerior\LaravelSidebar\Exceptions\LogicException;

/**
 * Class ContainerResolver
 * @package Samerior\LaravelSidebar\Infrastructure
 */
class ContainerResolver implements SidebarResolver
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $name
     *
     * @throws LogicException
     * @return Sidebar
     */
    public function resolve($name)
    {
        $sidebar = $this->container->make($name);

        if (!$sidebar instanceof Sidebar) {
            throw new LogicException('Your sidebar should implement the Sidebar interface');
        }

        $sidebar->build();

        return $sidebar;
    }
}
