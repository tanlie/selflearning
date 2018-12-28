<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 15:54
 */

namespace app\xiaochengxu\service;


use app\libs\exception\ParameterException;
use think\Cache;
use think\Exception;

class Token
{
    private $code;
    private $appid = 'wx7504d96591a979f6';
    private $appSecret = '764f0f12fe25cac3ff4f20cffd24b0c0';
    private $loginUrl = "https://api.weixin.qq.com/sns/jscode2session?".
                        "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code";

    public static function generateTokenByUid($uid)
    {
        $key = self::generateToken();
        $expire_in = config('secure.token_expire_time');
        $result = cache($key, $uid, $expire_in);
        if (!$result){
            throw new ParameterException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }

    public function getUserIdByToken($token)
    {
        $user_id = Cache::get($token);
        if($user_id){
            return $user_id;
        } else {
            return false;
        }
    }


    public function get($code)
    {
        $this->code = $code;
        $wxResult = $this->getWxResult(); //获取微信返回结果
        return $wxResult;
        //$user_id = 1;       //数据库中用户的ID
        //组装缓存数据
        //$cachedValue = $this->prepareCachedValue($wxResult,$user_id);
        //$token = $this->saveToCache($cachedValue);
        //$out['session_key'] = $wxResult['session_key'];
        //$out['openid'] =  $wxResult['openid'];
        //$out['unionid'] = $wxResult['unionid'];
        //$out['token'] = $token;
        //return $out;
    }

    public function getWxResult()
    {
        $login_url = sprintf($this->loginUrl,$this->appid,$this->appSecret,$this->code);
        $res = curl_get($login_url);
        $res = json_decode($res,true);

        if(empty($res)){
            throw new Exception('获取access_token及Openid失败');
        }
        $loginFail = array_key_exists('errcode',$res);
        if($loginFail){
            //登录失败
            throw new ParameterException([
                'msg'=> json_encode($res,JSON_UNESCAPED_UNICODE)
            ]);
        } else {
            //登录成功
            return $res;
        }
    }



    /*讲用户ID和权限保存到缓存中*/
    private function saveToCache($cachedValue)
    {
        $key = self::generateToken();
        $value = json_encode($cachedValue);
        $expire_in = '7200';
        $result = cache($key, $value, $expire_in);
        if (!$result){
            throw new ParameterException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }


    private function prepareCachedValue($wxResult, $uid)
    {
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = '112';
        return $cachedValue;
    }

    // 生成令牌
    public static function generateToken()
    {
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = 'spill in some salt';
        return md5($randChar . $timestamp . $tokenSalt);
    }

    public static function checkToken($token)
    {
        $exits = Cache::get($token);
        if($exits){
            return true;
        } else {
            return false;
        }
    }





}