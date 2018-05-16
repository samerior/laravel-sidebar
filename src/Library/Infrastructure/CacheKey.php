<?php

namespace Samerior\LaravelSidebar\Infrastructure;

/**
 * Class CacheKey
 * @package Samerior\LaravelSidebar\Infrastructure
 */
class CacheKey
{
    /**
     * @param  string $name
     * @param null $id
     *
     * @return string
     */
    public static function get($name, $id = null): string
    {
        if ($id) {
            $name .= '-' . $id;
        }
        return md5($name);
    }
}
