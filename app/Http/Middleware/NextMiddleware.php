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

class NextMiddleware extends BaseMiddleware
{
    public function handle(RequestInterface $request)
    {
        var_dump("Next Middle");

        if($this->next_node){
            $this->next_node->handle($request);
        }
    }
}