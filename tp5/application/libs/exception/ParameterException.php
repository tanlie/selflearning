<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 14:37
 */

namespace app\libs\exception;


class ParameterException extends BaseException
{
    public $code = '400';
    public $msg = 'parameter exception';
    public $errorCode = '40001';
    public $errorMsg = '参数错误';

}