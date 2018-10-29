<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 20:43
 */

namespace app\xiaochengxu\validate;
use app\libs\validate\BaseValidate;

class UpdateUserInfoValidate extends BaseValidate
{
    protected $rule = [
        'nickName' => '',
        'gender' => '',
        'language' => '',
        'city' => '',
        'province' => '',
        'country' => '',
        'avatarUrl' => '',
        ''
    ];

}