<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Tests\Stubs;

use Illuminate\Contracts\Container\Container;
use Samerior\LaravelSidebar\Traits\RouteableTrait;

/**
 * Class StubRouteableClass
 * @package Samerior\LaravelSidebar\Tests\Stubs
 */
class StubRouteableClass
{
    use RouteableTrait;

    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}
