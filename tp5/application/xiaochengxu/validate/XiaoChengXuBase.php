<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-05
 * Time: 19:45
 */

namespace app\xiaochengxu\validate;
use app\libs\validate\BaseValidate;


class XiaoChengXuBase extends BaseValidate
{

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