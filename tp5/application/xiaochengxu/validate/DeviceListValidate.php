<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-05
 * Time: 21:49
 */

namespace app\xiaochengxu\validate;


class DeviceListValidate extends XiaoChengXuBase
{
    protected $rule = [
        'sign' => 'require|isSignRight',
        'timestamp' => 'require'
    ];

}