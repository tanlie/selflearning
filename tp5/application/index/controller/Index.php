<?php
namespace app\index\controller;

use app\index\validate\TestValidate;
use app\libs\exception\ParameterException;

class Index
{
    public function index()
    {
        $res = (new TestValidate())->goCheck();
    }
}
