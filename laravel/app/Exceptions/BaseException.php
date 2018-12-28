<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-26
 * Time: 16:54
 */

namespace App\Exceptions;
use RuntimeException;

class BaseException extends RuntimeException
{
    public $code = 300;
    public $msg = 'unknow error';

}