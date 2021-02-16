<?php
/*
json {
  "method" : class::method,
  "params" : 参数
}
 */
 $client = new Swoole\Client(SWOOLE_SOCK_TCP);

 if (!$client->connect('127.0.0.1', 8500, -1)) {
     exit("connect failed. Error: {$client->errCode}\n");
 }

$data = [
  'method' => "App\Rpc\Service\DemoService::getUser",
  'params' => []
];

 $client->send(json_encode($data));

 echo $client->recv();

 $client->close();
