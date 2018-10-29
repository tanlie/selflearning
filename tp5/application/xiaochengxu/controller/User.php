<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 12:13
 */

namespace app\xiaochengxu\controller;


use think\Controller;

class User extends Controller
{

    public function getUser()
    {
        $out['code'] = 200;
        $out['msg'] = 'success';
        $out['data'] = [
            'name' => 'tanlie',
            'age' => '20',
            'city'=>'zhongshan'
        ];
        return json_encode($out);
    }

    public function getUser2()
    {
        $out['code'] = 300;
        $out['msg'] = '这是封装接口返回的数据';
        $out['data'] = [
            'name' => 'hello',
            'age' => 'world',
            'city'=>'beijing'
        ];
        return json_encode($out);
    }

}