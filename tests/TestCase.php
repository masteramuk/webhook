<?php

namespace Orchestra\Webhook\TestCase;

use Orchestra\Webhook\WebhookServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            WebhookServiceProvider::class,
        ];
    }
}
