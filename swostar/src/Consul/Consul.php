<?php
namespace SwoStar\Consul;

use Swoole\Coroutine\Http\Client;

class Consul
{
    protected $host;

    protected $port;

    public function __construct($host , $port)
    {
        $this->host = $host;
        $this->port = $port;
    }


    public function get(string $url = null, array $options = [])
    {
        return $this->request('GET', $url, $options);
    }

    public function delete(string $url, array $options = [])
    {
        return $this->request('DELETE', $url, $options);
    }

    public function put(string $url, array $options = [])
    {
        return $this->request('PUT', $url, $options);
    }

    public function patch(string $url, array $options = [])
    {
        return $this->request('PATCH', $url, $options);
    }

    public function post(string $url, array $options = [])
    {
        return $this->request('POST', $url, $options);
    }

    public function options(string $url, array $options = [])
    {
        return $this->request('OPTIONS', $url, $options);
    }

    private function request($method, $uri, $options)
    {
        $client = new Client($this->host, $this->port);
        $client->setMethod($method); // get , DELETE
        if (!empty($options)) {
            $client->setData(json_encode($options['body']));
        }
        $client->execute($uri);

        // Response
        $headers    = $client->headers;
        $statusCode = $client->statusCode;
        $body       = $client->body;

        $client->close();

        return Response::new($headers, $body, $statusCode);
    }
}
