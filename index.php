<?php

use vender\kernel\Kernel;

require "./autoload.php";

$http = new Swoole\Http\Server("0.0.0.0", 20010);

$http->on('request', function ($request, $response) {

    if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
        $response->end();
        return;
    }
    $kernel = new Kernel();
    $kernel->process($request,$response);
});

$http->start();