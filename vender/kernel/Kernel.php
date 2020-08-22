<?php
namespace vender\kernel;

use vender\http\Request;
use vender\http\Response;
use vender\router\Router;
use vender\middleware\MiddleHandle;

class Kernel{

    public function process(Request $request,Response $response){
        //调用中间件
        $middle = new MiddleHandle();
        $middle->dispatch($request);

        //获取控制器的类和方法
        $request_uri = $request->server['request_uri'];
        $method = $request->server['request_method'];
        $controller = Router::getRoute($request_uri,$method);
        list($controller,$action) = explode("@",$controller);
        $controller = "app\\Http\\Controller\\".$controller;
        $data = (new $controller)->$action($request,$response);
        $response->send($data);
    }

}