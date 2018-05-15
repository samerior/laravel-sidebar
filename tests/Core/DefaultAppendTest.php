<?php

namespace Samerior\LaravelSidebar\Tests\Core;

use Mockery as m;
use Samerior\LaravelSidebar\Contracts\Append;
use Samerior\LaravelSidebar\Library\Core\DefaultAppend;
use Illuminate\Contracts\Container\Container;

class DefaultAppendTest extends \PHPUnit_Framework_TestCase
{
    protected $container;

    /**
     * @var DefaultAppend
     */
    protected $append;

    protected function setUp()
    {
        $this->container = m::mock(Container::class);
        $this->append = new DefaultAppend($this->container);
    }

    public function test_can_instantiate_new_append()
    {
        $append = new DefaultAppend($this->container);

        $this->assertInstanceOf(Append::class, $append);
    }

    public function test_can_have_custom_appends()
    {
        $append = new StubAppend($this->container);

        $this->assertInstanceOf(Append::class, $append);
    }

    public function test_can_set_name()
    {
        $this->append->name('name');
        $this->assertEquals('name', $this->append->getName());
    }

    public function test_can_set_url()
    {
        $this->append->url('url');
        $this->assertEquals('url', $this->append->getUrl());
    }

    public function test_can_set_icon()
    {
        $this->append->icon('icon');
        $this->assertEquals('icon', $this->append->getIcon());
    }

    public function test_append_can_be_cached()
    {
        $this->append->name('name');
        $this->append->url('url');
        $this->append->icon('icon');

        $serialized = serialize($this->append);
        $unserialized = unserialize($serialized);

        $this->assertInstanceOf(Append::class, $unserialized);
        $this->assertEquals('name', $unserialized->getName());
        $this->assertEquals('url', $unserialized->getUrl());
        $this->assertEquals('icon', $unserialized->getIcon());
    }
}

class StubAppend extends DefaultAppend
{
}
