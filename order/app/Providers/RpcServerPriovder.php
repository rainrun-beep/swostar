<?php
namespace App\Providers;

use SwoStar\Rpc\RpcServerPriovder as ServerPriovder;

/**
 *
 */
class RpcServerPriovder extends ServerPriovder
{
    protected $services;

    protected function provider()
    {
        $this->services = function($sname){
            $services = $this->app->make('consul-agent')->health($sname)->getResult();
            $address= [];
            foreach ($services as $key => $value) {
                $address[] = [
                    "host" => $value["Service"]["Address"],
                    "port" => $value["Service"]["Port"]
                ];
            }
            return $address;
        };
    }

    public function boot()
    {
        parent::boot();
    }
}
