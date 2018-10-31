<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 12:13
 */

namespace app\xiaochengxu\controller;
use app\xiaochengxu\validate\CreateUserValidate;
use think\Request;

class UserController extends BaseController
{

    public function createUser(Request $request)
    {
        $validate = new CreateUserValidate();
        $validate->goCheck();
        $params = $request->param();
        $params = $validate->getDataByRule($params);
        var_dump($params);
    }











    public function getUser()
    {
        $request = Request::instance();
        $token = $request->header('token');
        $params = $request->param();
        //$this->checkToken($token);
        $out['return_code'] = 0;
        $out['msg'] = 'success';
        $out['data'] = $params;
        return json_encode($out);
    }

    public function getUser2()
    {
        $out['return_code'] = 300;
        $out['msg'] = '这是封装接口返回的数据';
        $out['data'] = [
            'name' => 'hello',
            'age' => 'world',
            'city'=>'beijing'
        ];
        return json_encode($out);
    }

}