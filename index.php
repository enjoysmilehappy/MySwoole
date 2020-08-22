<?php

use vender\kernel\Kernel;
use vender\container\Container;

require "./autoload.php";

$http = new Swoole\Http\Server("0.0.0.0", 20010);

$http->on('request', function ($request, $response) {
    try {
        //注册全局变量
        $container = Container::getInstance();
        $container->bind("hello", "world");
        $container->bind("\\vender\\container\\Request", $request);
        $container->bind("\\vender\\container\\Response", $response);
        if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
            $response->end();
            return;
        }
        $kernel = new Kernel();
        $kernel->process($request, $response);
    } catch (\Exception $e) {
        $response = Container::getInstance()->make("\\vender\\container\\Response");
        $response->end("<p><h1>" . $e->getMessage() . "</h1><h2>" . $e->getFile() . "</h2></p>" . "</h1><h2>" . $e->getLine() . "</h2></p>");
    }
});

$http->start();


