<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 15:08
 */

namespace app\index\validate;


use app\libs\validate\BaseValidate;

class TestValidate extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
        'tel'=>'isMobile'
    ];
    protected $message = [
        'tel' => '手机号码格式不正确~'
    ];

}