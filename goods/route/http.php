<?php
use SwoStar\Routes\Route;

Route::get('index', function(){
    return "this is route index() test";
});

Route::get('/index/demo', 'IndexController@demo');
Route::get('/index/rpc', 'IndexController@rpc');
Route::get('/index/show', 'IndexController@show');

// Route::get('/index/rpc1', 'IndexController@rpc1');
// Route::get('/index/rpc2', 'IndexController@rpc2');
/*

$routes = [
  "http" => [
      "get" => [
          "index" => call,
          "/index/demo" => 'IndexController@demo'
      ],
      "port"
      ...
  ]
  "websocket" => [

  ]
]
 */
