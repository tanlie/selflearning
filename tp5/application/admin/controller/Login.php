<?php
namespace app\admin\controller;
use app\index\model\WebAdmin as AdminModel;
use app\index\validate\LoginValidate;
use think\captcha\Captcha;
use think\Controller;
use think\Request;
use think\Session;

class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function verify()
    {
        $captcha = new Captcha();
        $captcha->fontSize = 30;
        $captcha->length   = 3;
        $captcha->useNoise = false;
        $captcha->reset = true;
        $captcha->useCurve = false;
        return $captcha->entry();
    }

    //验证登录
    public function checkAdmin(Request $request)
    {
       $validate = new LoginValidate();
       $validate->goCheck();
       $params = $request->param();
       $back = AdminModel::goCheckAdmin($params);
       return $back;
    }

    //退出登录
    public function logOut()
    {
        Session::clear();
        return $this->fetch('index');
    }





}
