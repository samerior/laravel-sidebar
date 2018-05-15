<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Contracts;

/**
 * Interface Group
 * @package Samerior\LaravelSidebar\Contracts
 */
interface Group extends Itemable, Authorizable
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     *
     * @return Group
     */
    public function name($name);

    /**
     * @param int $weight
     *
     * @return Group
     */
    public function weight($weight);

    /**
     * @return int
     */
    public function getWeight();

    /**
     * @param bool $hide
     *
     * @return Group
     */
    public function hideHeading($hide = true);

    /**
     * @return bool
     */
    public function shouldShowHeading();

    /**
     * @return \Illuminate\Support\Collection|Item[]
     */
    public function getItems();
}
