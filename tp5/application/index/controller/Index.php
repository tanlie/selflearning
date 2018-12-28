<?php
namespace app\index\controller;

use app\index\validate\TestValidate;
use app\libs\exception\ParameterException;

class Index
{
    public function index()
    {
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=wx7504d96591a979f6&secret=764f0f12fe25cac3ff4f20cffd24b0c0&js_code=0115R7ek18bypm0Wbrek1ZfIdk15R7e7&grant_type=authorization_code";
        $res = curl_get($url);
        var_dump($res);exit;

    }
}
