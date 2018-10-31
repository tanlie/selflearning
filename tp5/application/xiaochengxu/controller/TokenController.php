<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 15:50
 */

namespace app\xiaochengxu\controller;

use app\xiaochengxu\service\Token as TokenService;
use app\xiaochengxu\validate\GetTokenValidate;
use think\Cache;
use think\Request;

class TokenController extends BaseController
{
     public function getToken(Request $request)
     {
        $validate = new GetTokenValidate();
        $validate->goCheck();
        $params = $request->param();
        $params = $validate->getDataByRule($params);
        $code = $params['code'];
        $tokenService = new TokenService();
        $out = $tokenService->get($code);
        $out['code'] = '200';
        $out['msg'] = 'success';
        return json($out,200);
     }

     public function verifyToken()
     {
        $token = input('token');
        $exist = Cache::get($token);
        if($exist){
            $out['code'] = '200';
            $out['msg'] = 'success';
            $out['token'] = $token;
        } else {
            $out['code'] = '300';
            $out['msg'] = 'token 不存在或者已过期';
            $out['token'] = $token;
        }
        return json_encode($out,JSON_UNESCAPED_UNICODE);
     }

     public function updateUserInfo(Request $request)
     {
         $token = $request->header('token');
         $this->checkToken($token);
         $params = $request->param();
         setLogs('userInfo',json_encode($params));
         

     }








}