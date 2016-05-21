<?php

namespace Orchestra\Webhook;

use Laravie\Webhook\Client;
use Illuminate\Support\ServiceProvider;
use Http\Client\Common\HttpMethodsClient;
use Http\Adapter\Guzzle6\Client as GuzzleHttpClient;
use Http\Message\MessageFactory\GuzzleMessageFactory;

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
            $http = new HttpMethodsClient(new GuzzleHttpClient(), new GuzzleMessageFactory());

            return new Client($http);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['orchestra.webhook'];
    }
}
