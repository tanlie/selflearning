<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 15:50
 */

namespace app\xiaochengxu\controller;
use app\libs\exception\ParameterException;
use think\Cache;
use think\Controller;

class BaseController extends Controller
{

    protected function checkToken($token)
    {
        $exist = Cache::get($token);
        if(!$exist){
            throw new ParameterException([
                'msg' => 'token is invalid',
                'errorMsg' => 'token 无效'
            ]);
        } else {
            return true;
        }
    }

}