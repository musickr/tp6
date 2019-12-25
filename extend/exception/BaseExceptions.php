<?php
/**
 * Created by : PhpStorm
 * User: zhang
 * Date: 2019/12/25
 * Time: 11:22
 */

namespace exception;


use think\Exception;
use Throwable;

class BaseExceptions extends Exception
{
    public function __construct($err, Throwable $previous = null)
    {
        parent::__construct($err['msg'], $err['code'], $previous);
    }
}