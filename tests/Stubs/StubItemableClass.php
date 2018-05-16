<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Tests\Stubs;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Collection;
use Samerior\LaravelSidebar\Contracts\Itemable;
use Samerior\LaravelSidebar\Traits\CallableTrait;
use Samerior\LaravelSidebar\Traits\ItemableTrait;

/**
 * Class StubItemableClass
 * @package Samerior\LaravelSidebar\Tests\Stubs
 */
class StubItemableClass implements Itemable
{
    use ItemableTrait, CallableTrait;

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
        $this->items = new Collection();
    }
}
