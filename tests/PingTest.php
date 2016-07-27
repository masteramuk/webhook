<?php

namespace Orchestra\Webhook\TestCase;

use Orchestra\Webhook\Jobs\Ping;

class PingTest extends TestCase
{
    /**
     * @test
     */
    public function ping_website_using_get_should_succeed()
    {
        dispatch(new Ping('get', 'http://orchestraplatform.com'));
    }

    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Method Not Allowed
     */
    public function ping_website_using_post_should_fails()
    {
        dispatch(new Ping('POST', 'http://orchestraplatform.com'));
    }
}
