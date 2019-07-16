<?php

namespace Chocofamily\Pathcorrelation;

use Chocofamily\Pathcorrelation\Middleware\CorrelationId;
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
    {
        //$this->app->make('Teknomuslim\CurrencyFormatter\Controllers\CurrencyFormatterController');
        $this->app->singleton(CorrelationId::class, function () {
            return new CorrelationId();
        });
    }

    /**
     * Add the Cors middleware to the router.
     *
     */
    public function boot()
    {
            /** @var \Illuminate\Foundation\Http\Kernel $kernel */
            $kernel = $this->app->make(Kernel::class);
            // When the HandleCors middleware is not attached globally, add the CorrelationId
            if (! $kernel->hasMiddleware(CorrelationId::class)) {
                $kernel->prependMiddleware(CorrelationId::class);
            }
    }
}