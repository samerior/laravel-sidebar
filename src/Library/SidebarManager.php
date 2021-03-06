<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Library;

use Illuminate\Contracts\Container\Container;
use Samerior\LaravelSidebar\Contracts\SidebarFlusher;
use Samerior\LaravelSidebar\Contracts\SidebarResolver;
use Samerior\LaravelSidebar\Exceptions\LogicException;

/**
 * Class SidebarManager
 */
class SidebarManager
{
    /**
     * @var array
     */
    protected $sidebars = [];

    /**
     * @var
     */
    protected $container;

    /**
     * @var SidebarResolver
     */
    protected $resolver;

    /**
     * @param Container $container
     * @param SidebarResolver $resolver
     */
    public function __construct(Container $container, SidebarResolver $resolver)
    {
        $this->container = $container;
        $this->resolver = $resolver;
    }

    /**
     * Register the sidebar
     *
     * @param $name
     *
     * @throws LogicException
     * @return $this
     */
    public function register($name)
    {
        if (class_exists($name)) {
            $this->sidebars[] = $name;
        } else {
            throw new LogicException('Sidebar [' . $name . '] does not exist');
        }

        return $this;
    }

    /**
     * Bind sidebar instances to the ioC
     */
    public function resolve()
    {
        foreach ($this->sidebars as $name) {
            $sidebar = $this->resolver->resolve($name);

            $this->container->singleton($name, function () use ($sidebar) {
                return $sidebar;
            });
        }
    }

    /**
     * @param SidebarFlusher $flusher
     */
    public function flush(SidebarFlusher $flusher)
    {
        foreach ($this->sidebars as $name) {
            $flusher->flush($name);
        }
    }
}
