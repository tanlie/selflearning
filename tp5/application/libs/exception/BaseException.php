<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 14:19
 */

namespace app\libs\exception;

use think\Exception;

class BaseException extends Exception
{
    public $code;
    public $msg;
    public $errorCode;
    public $errorMsg;

    public function __construct($params = [])
    {
        if(!is_array($params)){
            return;
        }
        if(array_key_exists('code',$params)){
            $this->code = $params['code'];
        }
        if(array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errorCode',$params)){
            $this->errorCode = $params['errorCode'];
        }
        if(array_key_exists('errorMsg',$params)){
            $this->errorMsg = $params['errorMsg'];
        }
    }

}