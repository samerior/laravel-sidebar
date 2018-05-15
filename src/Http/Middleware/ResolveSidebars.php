<?php

namespace Samerior\LaravelSidebar\Http\Middleware;

use Samerior\LaravelSidebar\Library\SidebarManager;

/**
 * Class ResolveSidebars
 * @package Samerior\LaravelSidebar\Http\Middleware
 */
class ResolveSidebars
{
    /**
     * @var SidebarManager
     */
    protected $manager;

    /**
     * @param SidebarManager $manager
     */
    public function __construct(SidebarManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $this->manager->resolve();

        return $next($request);
    }
}
