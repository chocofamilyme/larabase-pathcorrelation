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
        //$this->app->make('CorrelationId');
        //$this->app->singleton(CorrelationId::class, function () {
        //    return new CorrelationId();
        //});

        $this->app->register(CorrelationId::class);
    }

    /**
     * Add the Cors middleware to the router.
     *
     */
    public function boot()
    {
            /** @var \Illuminate\Foundation\Http\Kernel $kernel */
           // $kernel = $this->app->make(Kernel::class);
            //if (! $kernel->hasMiddleware(CorrelationId::class)) {
            //    $kernel->prependMiddleware(CorrelationId::class);
            //}
    }
}