<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company     : Samerior Group
 */

namespace Samerior\LaravelSidebar\Contracts;

/**
 * Interface Badge
 * @package Samerior\LaravelSidebar\Contracts
 */
interface Badge extends Authorizable
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     *
     * @return Badge
     */
    public function setValue($value);

    /**
     * @return string
     */
    public function getClass();

    /**
     * @param string $class
     *
     * @return Badge
     */
    public function setClass($class);
}
