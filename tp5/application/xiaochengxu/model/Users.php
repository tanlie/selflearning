<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-31
 * Time: 14:06
 */

namespace app\xiaochengxu\model;

use app\xiaochengxu\service\Token as TokenService;
use app\libs\exception\ParameterException;
use app\xiaochengxu\controller\TokenController;

class Users extends BaseModel
{

    public  function create_user($params)
    {
        $exist = self::where('mobile',$params['mobile'])->find();
        if($exist){
            throw new ParameterException([
                'msg' => '此电话号码已经被注册过~'
            ]);
        } else {
            $token = new TokenService();
            $token_res = $token->get($params['code']);
            $grant_token = $token_res['token'];
            $new_params = array_merge($token_res,$params);
            unset($new_params['code'],$new_params['code']);
            $res = self::allowField(true)->save($new_params);
            return $grant_token;
        }
    }


}