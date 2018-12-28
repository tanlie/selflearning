<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-05
 * Time: 20:18
 */

namespace app\xiaochengxu\validate;


class IsUserValidate extends XiaoChengXuBase
{
    public $rule = [
        'sign' => 'require|isSignRight',
        'code' => 'require',
        'timestamp' => 'require'
    ];

}