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
use think\Request;

class BaseController extends Controller
{
    protected $key;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->key = config('secure.xiaochengxukey');
    }

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

    protected function getUserIdByToken($token)
    {
        $user_id = Cache::get($token);
        if(!$user_id){
            throw new ParameterException([
                'msg' => 'token is invalid',
                'errorMsg' => 'token 无效'
            ]);
        } else {
            return $user_id;
        }


    }



}