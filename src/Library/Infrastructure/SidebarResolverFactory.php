<?php

namespace Samerior\LaravelSidebar\Infrastructure;

use Samerior\LaravelSidebar\Exceptions\SidebarResolverNotSupported;

/**
 * Class SidebarResolverFactory
 * @package Samerior\LaravelSidebar\Infrastructure
 */
class SidebarResolverFactory
{
    /**
     * @param $name
     *
     * @throws SidebarResolverNotSupported
     * @return string
     */
    public static function getClassName($name): string
    {
        if ($name) {
            $class = __NAMESPACE__ . '\\' . studly_case($name) . 'CacheResolver';

            if (class_exists($class)) {
                return $class;
            }

            throw new SidebarResolverNotSupported('Chosen caching type is not supported. Supported: [static, user-based]');
        }

        return __NAMESPACE__ . '\\ContainerResolver';
    }
}
