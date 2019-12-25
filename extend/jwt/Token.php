<?php
/**
 * Created by : PhpStorm
 * User: zhang
 * Date: 2019/12/23
 * Time: 15:07
 */

namespace jwt;


use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

class Token
{
    private static $instance;
    //加密后的token
    private $token;
    //解析JWT得到的token
    private $decodeToken;
    //用户ID
    private $uid;
    //JWT密钥
    private $secret = 'adaeeqwffageqtqafsyweafw';
    //JWT参数
    private $iss = 'http://127.0.0.1:8000'; //签发者
    private $aud = 'http://127.0.0.1'; //配置听众
    private $id  = '1'; //配置ID(JTI声明)

    /**
     * 获取Token
     * @return string
     */
    public function getToken()
    {
        return (string)$this->token;
    }

    /**
     * 设置内部$Token的值
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * 设置内部$uid
     * @param $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 得到解密后的uid
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 加密JWT
     * @return $this
     */
    public function encode()
    {
        $time = time();
        $this -> token = (new Builder())
            -> setIssuer($this->iss)
            ->setAudience($this->aud)
            ->setId($this->id,true)
            ->setIssuedAt($time)
            ->setNotBefore($time + 60)
            ->setExpiration($time + 3600)
            ->set('uid',$this->uid)
            ->sign(new Sha256(),$this->secret)
            ->getToken();
        return $this;
    }

    /**
     * 解密Token
     * @return \Lcobucci\JWT\Token
     */
    public function decode()
    {
        if(!$this->decodeToken)
        {
            $this->decodeToken = (new Parser()) -> parse((string)$this->token);
            $this->uid = $this -> decodeToken -> getClaim('uid');
        }
        return $this->decodeToken;
    }

    /**
     * 验证令牌是否有效
     * @return bool
     */
    public function validate()
    {
        $data = new ValidationData();
        $data->setAudience($this->aud);
        $data->setIssuer($this->iss);
        $data->setId($this->id);
        return $this->decode()->validate($data);
    }

    /**
     * 验证令牌在生成后是否被修改
     * @return bool
     */
    public function verify()
    {
        return $this->decode()->verify(new Sha256(),$this->secret);
    }

    /**
     * 外部调用实例
     * @return Token
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 单例
     */
    private function __destruct(){}

    /**
     * 单例
     */
    private function __clone(){}

}