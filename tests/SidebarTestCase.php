<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Tests;

use Illuminate\Contracts\Container\Container;
use Orchestra\Testbench\TestCase;
use Samerior\LaravelSidebar\LaravelSidebarServiceProvider;

/**
 * Class SidebarTestCase
 * @package Samerior\LaravelSidebar\Tests
 */
class SidebarTestCase extends TestCase
{
    /**
     * @var Container
     */
    public $container;

    public function setContainer()
    {
        parent::setUp();
        $this->container = \Mockery::mock(Container::class);
    }

    protected function getPackageProviders($app)
    {
        return [LaravelSidebarServiceProvider::class];
    }
}
