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
    {
        //$this->app->register(CorrelationId::class);
        //$this->app->make('CorrelationId');
        $this->app->bind(CorrelationId::class, function ($app) {
            return new CorrelationId();
        });
    }

    /**
     *
     */
    public function boot()
    {
        /** @var \Illuminate\Foundation\Http\Kernel $kernel */
         $kernel = $this->app->make(Kernel::class);
        if (! $kernel->hasMiddleware(CorrelationId::class)) {
            $kernel->prependMiddleware(CorrelationId::class);
        }
    }
}