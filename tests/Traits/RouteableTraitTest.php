<?php

namespace Samerior\LaravelSidebar\Tests\Traits;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Routing\UrlGenerator;
use Samerior\LaravelSidebar\Tests\SidebarTestCase;
use Samerior\LaravelSidebar\Tests\Stubs\StubRouteableClass;

/**
 * Class RouteableTraitTest
 * @package Samerior\LaravelSidebar\Tests\Traits
 */
class RouteableTraitTest extends SidebarTestCase
{
    /**
     * @var StubItemableClass
     */
    protected $routeable;

    protected function setUp()
    {
        $this->setContainer();
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
