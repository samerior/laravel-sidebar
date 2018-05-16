<?php
/**
 * Author       : Samuel Dervis
 * Email        : sam@samerior.com
 * Company      : Samerior Group
 */

namespace Samerior\LaravelSidebar\Traits;

/**
 * Trait AuthorizableTrait
 * @package Samerior\LaravelSidebar\Library
 */
trait AuthorizableTrait
{
    /**
     * @var bool
     */
    protected $authorized = true;

    /**
     * Check if we are authorized to see this item/group
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return $this->authorized;
    }

    /**
     * Authorize the group/item
     *
     * @param bool $state
     *
     * @return $this
     */
    public function authorize($state = true): self
    {
        $this->authorized = $state;

        return $this;
    }
}
