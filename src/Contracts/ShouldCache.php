<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Contracts;

/**
 * Interface ShouldCache
 * @package Samerior\LaravelSidebar\Contracts
 */
interface ShouldCache extends \Serializable
{
    /**
     * @return array
     */
    public function getCacheables();
}
