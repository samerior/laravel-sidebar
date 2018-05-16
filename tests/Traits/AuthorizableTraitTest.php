<?php

namespace Samerior\LaravelSidebar\Tests\Traits;

use Samerior\LaravelSidebar\Tests\SidebarTestCase;
use Samerior\LaravelSidebar\Tests\Stubs\StubAuthorizableClass;

/**
 * Class AuthorizableTraitTest
 * @package Samerior\LaravelSidebar\Tests\Traits
 */
class AuthorizableTraitTest extends SidebarTestCase
{
    /**
     * @var
     */
    protected $routeable;

    protected function setUp()
    {
        $this->setContainer();
        $this->routeable = new StubAuthorizableClass();
    }

    public function test_can_authorize()
    {
        $this->routeable->authorize(true);
        $this->assertTrue($this->routeable->isAuthorized());

        $this->routeable->authorize(false);
        $this->assertFalse($this->routeable->isAuthorized());
    }
}
