<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Library\Core;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Collection;
use Samerior\LaravelSidebar\Contracts\Group;
use Samerior\LaravelSidebar\Exceptions\LogicException;
use Samerior\LaravelSidebar\Traits\AuthorizableTrait;
use Samerior\LaravelSidebar\Traits\CacheableTrait;
use Samerior\LaravelSidebar\Traits\CallableTrait;
use Samerior\LaravelSidebar\Traits\ItemableTrait;

/**
 * Class DefaultGroup
 * @package Samerior\LaravelSidebar\Library\Core
 */
class DefaultGroup implements Group, \Serializable
{
    use CallableTrait, CacheableTrait, ItemableTrait, AuthorizableTrait;
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $weight = 0;

    /**
     * @var bool
     */
    protected $heading = true;

    /**
     * @var Container
     */
    protected $container;

    /**
     * Data that should be cached
     * @var array
     */
    protected $cacheables = [
        'name',
        'items',
        'weight',
        'heading'
    ];

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->items = new Collection();
    }

    /**
     * @param string $name
     *
     * @return Group
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $weight
     *
     * @return Group
     * @throws LogicException
     */
    public function weight($weight)
    {
        if (!is_int($weight)) {
            throw new LogicException('Weight should be an integer');
        }

        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param bool $hide
     *
     * @return Group
     */
    public function hideHeading($hide = true)
    {
        $this->heading = !$hide;

        return $this;
    }

    /**
     * @return bool
     */
    public function shouldShowHeading()
    {
        return $this->heading ? true : false;
    }
}
