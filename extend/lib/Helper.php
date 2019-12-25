<?php
/**
 * Created by : PhpStorm
 * User: zhang
 * Date: 2019/12/25
 * Time: 14:02
 */

namespace lib;


use think\Response;

class Helper
{
    public static function jsonData($code = 0, $msg = 'Success', $data = [])
    {
        return Response::create(compact('code','msg','data'),'json');
    }
    public static function jsonSuccess($data)
    {
        $code = 0;
        $msg  = 'success';
        return Response::create(compact('code','msg','data'),'json');
    }
}