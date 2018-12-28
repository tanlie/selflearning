<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-26
 * Time: 16:54
 */

namespace App\Exceptions;


class ParameterException extends BaseException
{
    public $code = 333;
    public $msg = '555';

}