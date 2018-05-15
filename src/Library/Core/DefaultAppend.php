<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Library\Core;

use Illuminate\Contracts\Container\Container;
use Samerior\LaravelSidebar\Contracts\Append;
use Samerior\LaravelSidebar\Traits\AuthorizableTrait;
use Samerior\LaravelSidebar\Traits\CacheableTrait;
use Samerior\LaravelSidebar\Traits\CallableTrait;
use Samerior\LaravelSidebar\Traits\RouteableTrait;

/**
 * Class DefaultAppend
 * @package Samerior\LaravelSidebar\Library\Core
 */
class DefaultAppend implements Append, \Serializable
{
    use CallableTrait, CacheableTrait, RouteableTrait, AuthorizableTrait;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var string|null
     */
    protected $name = null;

    /**
     * @var string
     */
    protected $icon = 'fa fa-plus';

    /**
     * @var array
     */
    protected $cacheables = [
        'name',
        'url',
        'icon'
    ];

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     *
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     *
     * @return $this
     */
    public function icon($icon)
    {
        $this->icon = $icon;

        return $this;
    }
}
