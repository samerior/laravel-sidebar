<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Traits;

use Illuminate\Routing\RouteDependencyResolverTrait;
use ReflectionFunction;

/**
 * Trait CallableTrait
 * @package Samerior\LaravelSidebar\Traits
 */
trait CallableTrait
{
    use RouteDependencyResolverTrait;

    /**
     * Preform a callback on this workbook instance.
     *
     * @param \Closure|null $callback
     * @param null $caller
     *
     * @return $this
     * @throws \ReflectionException
     */
    public function call(\Closure $callback = null, $caller = null)
    {
        if ($callback instanceof \Closure) {
            // Make dependency injection possible
            $parameters = $this->resolveMethodDependencies(
                [$caller], new ReflectionFunction($callback)
            );
            \call_user_func_array($callback, $parameters);
        }

        return $caller;
    }
}
