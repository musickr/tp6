<?php
declare (strict_types = 1);

namespace app\api\controller;

use jwt\Token;

class Index
{
    protected $middleware = [
        'token' => ['except' 	=> ['index']]
    ];

    public function index()
    {
        $authToken = Token::getInstance();
        $token = $authToken->setUid(1)->encode()->getToken();
        return $token;
    }
    public function auth()
    {
        return Token::getInstance()->getUid();
    }
}
