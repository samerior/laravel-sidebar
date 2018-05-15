<?php

namespace Samerior\LaravelSidebar;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Samerior\LaravelSidebar\Contracts\Append;
use Samerior\LaravelSidebar\Contracts\Badge;
use Samerior\LaravelSidebar\Contracts\Group;
use Samerior\LaravelSidebar\Contracts\Item;
use Samerior\LaravelSidebar\Contracts\Menu;
use Samerior\LaravelSidebar\Contracts\SidebarRenderer;
use Samerior\LaravelSidebar\Infrastructure\SidebarFlusher;
use Samerior\LaravelSidebar\Infrastructure\SidebarFlusherFactory;
use Samerior\LaravelSidebar\Infrastructure\SidebarResolver;
use Samerior\LaravelSidebar\Infrastructure\SidebarResolverFactory;
use Samerior\LaravelSidebar\Library\Core\DefaultAppend;
use Samerior\LaravelSidebar\Library\Core\DefaultBadge;
use Samerior\LaravelSidebar\Library\Core\DefaultGroup;
use Samerior\LaravelSidebar\Library\Core\DefaultItem;
use Samerior\LaravelSidebar\Library\Core\DefaultMenu;
use Samerior\LaravelSidebar\Library\Laravel\SidebarRenderer as DefaultSidebarRenderer;
use Samerior\LaravelSidebar\Library\SidebarManager;

class LaravelSidebarServiceProvider extends ServiceProvider
{
    protected $shortName = 'samerior.sidebar';


    /**
     * Boot the service provider.
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        // Register config
        $this->registerConfig();
        $this->registerBinding();
    }

    /**
     * Register config
     * @return void
     */
    protected function registerConfig()
    {
        $location = __DIR__ . '/../config/' . $this->shortName . '.php';

        $this->mergeConfigFrom(
            $location, $this->shortName
        );

        $this->publishes([
            $location => config_path($this->shortName . '.php'),
        ], 'config');
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return [
            Menu::class,
            Item::class,
            Group::class,
            Badge::class,
            Append::class,
            SidebarManager::class,
            SidebarRenderer::class,
            SidebarResolver::class,
        ];
    }

    /**
     * Register views.
     * @return void
     */
    protected function registerViews()
    {
        $location = __DIR__ . '/../resources/views';

        $this->loadViewsFrom($location, $this->shortName);

        $this->publishes([
            $location => base_path('resources/views/vendor/' . $this->shortName),
        ], 'views');
    }

    private function registerBinding()
    {
        // Bind SidebarResolver
        $this->app->bind(SidebarResolver::class, function (Application $app) {

            $resolver = SidebarResolverFactory::getClassName(
                $app['config']->get($this->shortName . '.cache.method')
            );

            return $app->make($resolver);
        });

        // Bind SidebarFlusher
        $this->app->bind(SidebarFlusher::class, function (Application $app) {

            $resolver = SidebarFlusherFactory::getClassName(
                $app['config']->get($this->shortName . '.cache.method')
            );

            return $app->make($resolver);
        });

        // Bind manager
        $this->app->singleton(SidebarManager::class);

        // Bind Menu
        $this->app->bind(Menu::class, DefaultMenu::class);

        // Bind Group
        $this->app->bind(Group::class, DefaultGroup::class);

        // Bind Item
        $this->app->bind(Item::class, DefaultItem::class);

        // Bind Badge
        $this->app->bind(Badge::class, DefaultBadge::class);

        // Bind Append
        $this->app->bind(Append::class, DefaultAppend::class);

        // Bind Renderer
        $this->app->bind(SidebarRenderer::class, DefaultSidebarRenderer::class);
    }
}
