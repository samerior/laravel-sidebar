<?php

namespace Samerior\LaravelSidebar\Infrastructure;

use Samerior\LaravelSidebar\Exceptions\SidebarFlusherNotSupported;

/**
 * Class SidebarFlusherFactory
 * @package Samerior\LaravelSidebar\Infrastructure
 */
class SidebarFlusherFactory
{
    /**
     * @param $name
     *
     * @throws SidebarFlusherNotSupported
     * @return string
     */
    public static function getClassName($name): string
    {
        if ($name) {
            $class = __NAMESPACE__ . '\\' . studly_case($name) . 'SidebarFlusher';

            if (class_exists($class)) {
                return $class;
            }

            throw new SidebarFlusherNotSupported('Chosen caching type is not supported. Supported: [static, user-based]');
        }

        return __NAMESPACE__ . '\\NullSidebarFlusher';
    }
}
