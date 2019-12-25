<?php
/**
 * Created by : PhpStorm
 * User: zhang
 * Date: 2019/12/25
 * Time: 14:06
 */

namespace lib;


class Error
{
    const SUCCESS        = ['code'=>0,'msg'=>'success'];
    const UNKNoWN_ERR    = ['code'=>1,'msg'=>'未知错误'];
    const ERR_URL        = ['code'=>2,'msg'=>'访问接口不存在'];
    const TOKEN_ERR      = ['code'=>3,'msg'=>'token错误'];
    const NO_TOKEN_ERR   = ['code'=>4,'msg'=>'token不存在'];
    const USER_NOT_EXIST = ['code'=>5,'msg'=>'用户不存在'];
}