<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-08
 * Time: 14:38
 */

namespace app\admin\controller;


use think\Controller;
use think\Session;

class BaseController extends Controller
{
    public function _initialize()
    {
        $admin = Session::get('admin');
        if(!$admin){
            $this->error('您还没有登陆，请先登陆哦','Login/index','',2);
        } else {
            $this->shop_id = $_SESSION['admin']['shop_id'];
            return true;
        }
    }


}