<?php
/**
 * Created by PhpStorm.
 * User: hengda
 * Date: 2020/8/22
 * Time: 11:24
 */

namespace app\Http\Middleware;

use vender\contract\middleware\BaseMiddleware;
use vender\contract\RequestInterface;

class BeforeMiddleware extends BaseMiddleware
{
    public function handle(RequestInterface $request)
    {
        var_dump("Before Middle");
        if($this->next_node){
            $this->next_node->handle($request);
        }
    }
}