<?php

namespace Samerior\LaravelSidebar\Contracts;

/**
 * Interface Routeable
 * @package Samerior\LaravelSidebar\Contracts
 */
interface Routeable
{
    /**
     * @return string
     */
    public function getUrl();

    /**
     * @param string $url
     *
     * @return $this
     */
    public function url($url);

    /**
     * @param       $route
     * @param array $params
     *
     * @return $this
     */
    public function route($route, $params = []);
}
