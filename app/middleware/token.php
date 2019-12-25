<?php
declare (strict_types = 1);

namespace app\middleware;

use exception\BaseExceptions;
use lib\Error;

class token
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure $next
     * @return void
     * @throws BaseExceptions
     */
    public function handle($request, \Closure $next)
    {
        //
        $token = $request->param('token');
        if($token)
        {
            $authToken = \jwt\Token::getInstance();
            $authToken -> setToken($token);
            if($authToken->validate() && $authToken->verify())
            {
                return $next($request);
            }else{
                throw new BaseExceptions(Error::TOKEN_ERR);
            }
        }else{
            throw new BaseExceptions(Error::NO_TOKEN_ERR);
        }
    }
}
