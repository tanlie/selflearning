<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 14:46
 */

namespace app\libs\validate;
use app\libs\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    /*基础验证方法*/
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();
        $res = $this->batch()->check($params);
        //$res = $this->check($params);
        if(!$res){
            //验证不通过，写日志
            setLogs('request_error',json_encode($params,JSON_UNESCAPED_UNICODE));
            $e = new ParameterException([
                'msg' => is_array($this->error)? implode(';',$this->error) : $this->error
            ]);
            throw $e;
        }
        return true;
    }

    /*根据规则获取指定参数，过滤不必要参数*/
    public function getDataByRule($params){
        $new_array = [];
        foreach($this->rule as $key => $val) {
            if(array_key_exists($key,$params)) {
                $new_array[$key] = $params[$key];
            }
        }
        unset($new_array['timestamp'],$new_array['sign']);
        return $new_array;
    }

    /*判断是否是正整数*/
    protected function isPositiveInteger($value, $rule='', $data='', $field='')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return $field . '必须是正整数';
    }

    //没有使用TP的正则验证，集中在一处方便以后修改
    //不推荐使用正则，因为复用性太差
    //手机号的验证规则
    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|6|7|8|9)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    protected function createSign($key)
    {
        $request = Request::instance();
        $params = $request->param();
        ksort($params);
        $string = $this->ToUrlParams($params);
        $string = $string."&key=".$key;
        $string = preg_replace('# #','',$string);
        //setLogs('request_error',$string);
        $result = md5($string);
        //$result = strtolower($result);;
        return $result;

    }

    protected function ToUrlParams($params)
    {
        $buff = "";
        foreach ($params as $k => $v)
        {
            // if($k != "sign" && $v != "" && !is_array($v)){
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