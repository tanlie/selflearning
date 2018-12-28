<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-05
 * Time: 20:11
 */

namespace app\xiaochengxu\validate;


class GetMsgCodeValidate extends XiaoChengXuBase
{
    protected $rule = [
        'sign' => 'require|isSignRight',
        'mobile' => 'require|isMobile',
        'timestamp' => 'require'
    ];

}