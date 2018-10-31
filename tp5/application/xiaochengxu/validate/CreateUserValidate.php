<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-31
 * Time: 11:54
 */

namespace app\xiaochengxu\validate;


use app\libs\validate\BaseValidate;

class CreateUserValidate extends BaseValidate
{
    protected $rule = [
        'code' => 'require',
        'user_name' => 'require|length:4,100',
        'pass_word' => 'require|length:4,100',
        'mobile' => 'require|isMobile',
        'timestamp' => 'require',
        'sign' => 'require', //isSignRight
    ];
    protected $message = [
        'code' => '请带code',
        'user_name' => '用户名不能为空，长度为4-100位~',
        'pass_word' => '密码不能为空，长度为4-100位~',
        'mobile' => '手机号码不正确',
        'timestamp' => '请传入timestamp',
        'sign' => '签名不正确',
    ];

    protected function isSignRight($value)
    {
        $key = config('secure.xiaochengxukey');
        $check = $this->createSign($key);
        if($value != $check){
            return false;
        }
        return true;
    }
}