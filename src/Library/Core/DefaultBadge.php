<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Library\Core;

use Illuminate\Contracts\Container\Container;
use Samerior\LaravelSidebar\Contracts\Badge;
use Samerior\LaravelSidebar\Traits\AuthorizableTrait;
use Samerior\LaravelSidebar\Traits\CacheableTrait;
use Samerior\LaravelSidebar\Traits\CallableTrait;

/**
 * Class DefaultBadge
 * @package Samerior\LaravelSidebar\Library\Core
 */
class DefaultBadge implements Badge, \Serializable
{
    use CallableTrait, CacheableTrait, AuthorizableTrait;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var mixed
     */
    protected $value = null;

    /**
     * @var string
     */
    protected $class = 'badge badge-default';

    /**
     * @var array
     */
    protected $cacheables = [
        'value',
        'class'
    ];

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return Badge
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     *
     * @return Badge
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }
}
