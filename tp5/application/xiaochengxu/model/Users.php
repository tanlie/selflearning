<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-31
 * Time: 14:06
 */

namespace app\xiaochengxu\model;

use app\libs\exception\ParameterException;
use app\xiaochengxu\service\Token as TokenService;

class Users extends BaseModel
{

    public  function user_register($params)
    {
        $exist = self::where('mobile',$params['mobile'])->find();
        if($exist){
            throw new ParameterException([
                'msg' => '此电话号码已经被注册过~'
            ]);
        } else {
            $token = new TokenService();
            $token_res = $token->get($params['code']);
            $new_params = array_merge($token_res,$params);
            unset($new_params['code']);
            $res = self::allowField(true)->create($new_params);
            return $res->user_id;
        }
    }

    public function user_login($params)
    {
        $res = self::where($params)->find();
        if($res){
            return $this->user_get_login_data($res->user_id);
        } else {
            return false;
        }
    }

    public function user_get_login_data($user_id)
    {
        $token = TokenService::generateTokenByUid($user_id);
        $out = [
            'token' => $token,
            'daily_income' => '30',
            'total_income' => '298',
            'device_count' => 5,
            'device_online' => 2
        ];
        return $out;
    }


}