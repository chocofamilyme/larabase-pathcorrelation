<?php

namespace Chocofamily\Pathcorrelation;

use Chocofamily\Pathcorrelation\Http\CorrelationId;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class CorrelationIdServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {}

    /**
     *
     */
    public function boot()
    {
        $this->app->bind(CorrelationId::class, function ($app) {
            return new CorrelationId();
        });

        $this->registerMiddleware(CorrelationId::class);
    }

    /**
     * Register the Middleware
     *
     * @param  string $middleware
     */
    protected function registerMiddleware($middleware)
    {
        $kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
        $kernel->pushMiddleware($middleware);
    }
}