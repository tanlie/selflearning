<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/3
 * Time: 14:57
 */

namespace app\socket\controller;


use think\Controller;

class Index extends Controller
{

    public function index(){

        echo 222;
    }

    public function socket(){
        return $this->fetch('test');
    }

}