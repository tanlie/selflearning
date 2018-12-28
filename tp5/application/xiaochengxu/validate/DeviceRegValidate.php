<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-05
 * Time: 21:18
 */

namespace app\xiaochengxu\validate;


class DeviceRegValidate extends XiaoChengXuBase
{
    public $rule = [
        'sign' => 'require|isSignRight',
        'timestamp' => 'require',
        'device_no' => 'require'
    ];

}