<?php

namespace Orchestra\Webhook;

use Illuminate\Support\ServiceProvider;

class WebhookServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('orchestra.webhook', function ($app) {
            return Client::make();
        });
    }
}
