<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Traits;

/**
 * Trait RouteableTrait
 * @package Samerior\LaravelSidebar\Traits
 */
trait RouteableTrait
{
    /**
     * @var string
     */
    protected $url = '#';

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function url($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param       $route
     * @param array $params
     *
     * @return $this
     */
    public function route($route, $params = [])
    {
        $this->url(
            $this->container->make('url')->route($route, $params)
        );

        return $this;
    }
}
