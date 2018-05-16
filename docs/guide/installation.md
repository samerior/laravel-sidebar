
## Install

Via Composer

``` bash
$ composer require samerior/laravel-sidebar
```
## Middleware

Add the package middleware to `App\Http\Kernel`:

``` \Samerior\LaravelSidebar\Http\Middleware\ResolveSidebars::class```

as shown below
```php
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
        \Samerior\LaravelSidebar\Http\Middleware\ResolveSidebars::class      
    ];

```
## Publish Assets

To publish the default views use:

```php
php artisan vendor:publish --tag="views"
```

To publish the config use:

```php
php artisan vendor:publish --tag="config"
```
