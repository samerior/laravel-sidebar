<?php

namespace Samerior\LaravelSidebar\Contracts;

/**
 * Interface Authorizable
 * @package Samerior\LaravelSidebar\Contracts
 */
interface Authorizable
{
    /**
     * Check if we are authorized to see this item/group
     * @return mixed
     */
    public function isAuthorized();

    /**
     * Authorize the group/item
     *
     * @param bool $state
     *
     * @return $this
     */
    public function authorize($state = true);
}
