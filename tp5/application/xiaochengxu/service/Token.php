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

class Token
{
    private $openId;
    public  function get($openId)
    {
        $this->openId = $openId;
        $wxResult = [
            'openid' => 'XXXXX',
            'nickName' => 'tanlie',
            'city' => 'zhongshan'
        ]; //获取微信返回结果
        $user_id = 1;       //数据库中用户的ID
        //组装缓存数据
        $cachedValue = $this->prepareCachedValue($wxResult,$user_id);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }



    /*讲用户ID和权限保存到缓存中*/
    private function saveToCache($cachedValue)
    {
        $key = self::generateToken();
        $value = json_encode($cachedValue);
        $expire_in = '20';
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