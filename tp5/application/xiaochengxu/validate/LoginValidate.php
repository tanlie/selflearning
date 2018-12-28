<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-05
 * Time: 19:11
 */

namespace app\xiaochengxu\validate;


class LoginValidate extends XiaoChengXuBase
{
    protected $rule = [
        'sign' => 'require|isSignRight',
        'mobile'=>'require',
        'pass_word' =>'require',
        'timestamp' =>'require'
    ];


}