<?php

namespace Samerior\LaravelSidebar\Infrastructure;

use Illuminate\Contracts\Cache\Repository;
use Samerior\LaravelSidebar\Exceptions\CacheTagsNotSupported;

/**
 * Class SupportsCacheTags
 * @package Samerior\LaravelSidebar\Infrastructure
 */
class SupportsCacheTags
{
    /**
     * @param Repository $repository
     *
     * @throws CacheTagsNotSupported
     * @return bool
     */
    public function isSatisfiedBy(Repository $repository): bool
    {
        if (!method_exists($repository->getStore(), 'tags')) {
            throw new CacheTagsNotSupported('Cache tags are necessary to use this kind of caching. Consider using a different caching method');
        }

        return true;
    }
}
