<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-05
 * Time: 20:37
 */

namespace app\xiaochengxu\validate;


class ChangePasswdValidate extends XiaoChengXuBase
{
    protected $rule = [
        'sign' => 'require|isSignRight',
        'timestamp' => 'require',
        'new_pass_word' => 'require|length:4,50'
    ];

}