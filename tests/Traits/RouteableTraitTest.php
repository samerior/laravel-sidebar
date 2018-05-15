<?php

namespace Samerior\LaravelSidebar\Tests\Traits;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Routing\UrlGenerator;
use Samerior\LaravelSidebar\Traits\RouteableTrait;

class RouteableTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var StubItemableClass
     */
    protected $routeable;

    protected function setUp()
    {
        $this->container = \Mockery::mock(Container::class);
        $this->routeable = new StubRouteableClass($this->container);
    }

    public function test_can_set_url()
    {
        $this->routeable->url('url');

        $this->assertEquals('url', $this->routeable->getUrl());
    }

    public function test_can_set_route()
    {
        $urlMock = \Mockery::mock(UrlGenerator::class);
        $urlMock->shouldReceive('route')->andReturn('url');

        $this->container->shouldReceive('make')->andReturn($urlMock);

        $this->routeable->route('route');

        $this->assertEquals('url', $this->routeable->getUrl());
    }
}

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
