<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 14:32
 */

namespace app\index\controller;


class SignController
{
    public static function createSign($params,$key)
    {
        ksort($params);
        $string = self::ToUrlParams($params);
        $string = $string."&key=".$key;
        //setLogs('sign',$string);
        //签名步骤三：MD5加密
        $result = md5($string);
        return $result;
    }

    private static function ToUrlParams($params)
    {
        $buff = "";
        foreach ($params as $k => $v)
        {
            if($k != "sign" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
            if(is_array($v)){
                $temp = json_encode($v);
                $buff .= $k . "=" . $temp . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }

}