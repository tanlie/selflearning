<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 15:55
 */

namespace app\xiaochengxu\validate;


use app\libs\validate\BaseValidate;

class GetTokenValidate extends BaseValidate
{
    protected $rule = [
        'openId' => 'require'
    ];

    protected $message = [
        'openId' => '没有openid不能给你token啊~'
    ];

}