<?php

namespace Samerior\LaravelSidebar\Infrastructure;

use Illuminate\Contracts\Cache\Repository as Cache;
use Samerior\LaravelSidebar\Contracts\SidebarFlusher;

/**
 * Class UserBasedSidebarFlusher
 * @package Samerior\LaravelSidebar\Infrastructure
 */
class UserBasedSidebarFlusher implements SidebarFlusher
{
    /**
     * @var Cache
     */
    protected $cache;

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Flush
     *
     * @param $name
     * @throws \Samerior\LaravelSidebar\Exceptions\CacheTagsNotSupported
     */
    public function flush($name)
    {
        if ((new SupportsCacheTags())->isSatisfiedBy($this->cache)) {
            $this->cache->tags(CacheKey::get($name))->flush();
        }
    }
}
