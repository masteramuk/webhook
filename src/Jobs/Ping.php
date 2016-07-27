<?php

namespace Orchestra\Webhook\Jobs;

use RuntimeException;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Ping implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    /**
     * HTTP Method.
     *
     * @var string
     */
    public $method;

    /**
     * Request URI.
     *
     * @var string
     */
    public $uri;

    /**
     * Request Data.
     *
     * @var mixed
     */
    public $data = [];

    /**
     * Request headers.
     *
     * @var array
     */
    public $headers = [];

    /**
     * Contruct a new Ping.
     *
     * @param string  $method
     * @param string  $uri
     * @param mixed  $data
     * @param array  $headers
     */
    public function __contruct($method, $uri, $data = [], array $headers = [])
    {
        $this->method  = Str::upper($method);
        $this->uri     = $uri;
        $this->data    = $data;
        $this->headers = $headers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = app('orchestra.webhook');

        $response = $client->send($this->method, $this->uri, $this->data, $this->headers);

        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException($response->getReasonPhrase(), $response->getStatusCode());
        }
    }
}
