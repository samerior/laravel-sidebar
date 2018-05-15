<?php

namespace Samerior\LaravelSidebar\Tests\Core;

use Samerior\LaravelSidebar\Contracts\Badge;
use Samerior\LaravelSidebar\Library\Core\DefaultBadge;
use Samerior\LaravelSidebar\Tests\SidebarTestCase;
use Samerior\LaravelSidebar\Tests\Stubs\StubBadge;

class DefaultBadgeTest extends SidebarTestCase
{

    protected $container;

    /**
     * @var DefaultBadge
     */
    protected $badge;

    protected function setUp()
    {
        $this->setContainer();
        $this->badge = new DefaultBadge($this->container);
    }

    public function test_can_instantiate_new_badge()
    {
        $badge = new DefaultBadge($this->container);

        $this->assertInstanceOf(Badge::class, $badge);
    }

    public function test_can_have_custom_badges()
    {
        $badge = new StubBadge($this->container);

        $this->assertInstanceOf(Badge::class, $badge);
    }

    public function test_can_set_value()
    {
        $this->badge->setValue('value');
        $this->assertEquals('value', $this->badge->getValue());
    }

    public function test_can_set_class()
    {
        $this->badge->setClass('class');
        $this->assertEquals('class', $this->badge->getClass());
    }

    public function test_badge_can_be_cached()
    {
        $this->badge->setValue('value');
        $this->badge->setClass('class');

        $serialized = serialize($this->badge);
        $unserialized = unserialize($serialized);

        $this->assertInstanceOf(Badge::class, $unserialized);
        $this->assertEquals('value', $unserialized->getValue());
        $this->assertEquals('class', $unserialized->getClass());
    }
}
