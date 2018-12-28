<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-29
 * Time: 12:13
 */

namespace app\xiaochengxu\controller;
use app\libs\exception\ParameterException;
use app\xiaochengxu\service\Token as TokenService;
use app\libs\SignatureHelper;
use app\xiaochengxu\validate\ChangePasswdValidate;
use app\xiaochengxu\validate\GetMsgCodeValidate;
use app\xiaochengxu\validate\IsUserValidate;
use app\xiaochengxu\validate\LoginValidate;
use app\xiaochengxu\validate\RegisterValidate;
use think\Cache;
use think\Exception;
use think\Request;
use app\xiaochengxu\model\Users as UsersModel;

class UserController extends BaseController
{
    /*商户注册*/
    public function register(Request $request)
    {
        $validate = new RegisterValidate();
        $validate->goCheck();
        $params = $request->param();
        $params = $validate->getDataByRule($params);
        $user = new UsersModel();
        $user_id = $user->user_register($params);
        $token = TokenService::generateTokenByUid($user_id);
        $out['return_code'] = 0;
        $out['return_msg'] = 'success';
        $out['data']['token'] = $token;
        $key = $this->key;
        $out['sign'] = SignController::createSign($out,$key);
        return json_encode($out);
    }
    /*商户登录*/
    public function login(Request $request)
    {
        $validate = new LoginValidate();
        $validate->goCheck();
        $params = $request->param();
        $params = $validate->getDataByRule($params);
        $user = new UsersModel();
        $data = $user->user_login($params);
        if(!$data){
            throw new ParameterException([
                'msg' => '用户不存在或者密码不正确~'
            ]);
        }
        $out['return_code'] = 0;
        $out['return_msg'] = 'success';
        $out['data'] = $data;
        $key = $this->key;
        $out['sign'] = SignController::createSign($out,$key);
        return json_encode($out);
    }

    /*获取注册时的手机验证码*/
    public function getMsgCode(Request $request)
    {
        $validate = new GetMsgCodeValidate();
        $validate->goCheck();
        $params = $request->param();
        $mobile = $params['mobile'];
        $msg_code = rand(1000,9999);
        $this->sendAliyunSms($mobile,$msg_code);
        $out['return_code'] = 0;
        $out['return_msg'] = 'success';
        $out['timestamp'] = strval(time());
        $out['data']['msg_code'] = $msg_code;
        $key = $this->key;
        $out['sign'] = SignController::createSign($out,$key);
        return json_encode($out);
    }

    /*判断用户是否存在*/
    public function isUser(Request $request)
    {
        $validate = new IsUserValidate();
        $validate->goCheck();
        $params = $request->param();
        $params = $validate->getDataByRule($params);
        $token = new TokenService();
        $wxResult = $token->get($params['code']);
        $openid = $wxResult['openid'];
        $res = UsersModel::where('openid',$openid)->find();
        if(!$res){
            throw new ParameterException([
                'msg' => 'user does no exist'
            ]);
        }

        $token = TokenService::generateTokenByUid($res->user_id);
        $out['return_code'] = 0;
        $out['return_msg'] = 'success';
        $out['data']['token'] = $token;
        $key = $this->key;
        $out['sign'] = SignController::createSign($out,$key);
        return json_encode($out);
    }

    /*用户修改密码*/
    public function changePassWord(Request $request)
    {
        (new ChangePasswdValidate())->goCheck();
        $token = $request->header('token');
        $user_id = Cache::get($token);
        if(!$user_id){
            throw new ParameterException([
                'msg' => 'token 无效或已过期~'
            ]);
        }
        $passwd['pass_word'] = $request->param('new_pass_word');
        $user = new UsersModel();
        $res = $user->where('user_id',$user_id)->update($passwd);
        $out['return_code'] = 0;
        $out['return_msg'] = 'success';
        $key = $this->key;
        $out['sign'] = SignController::createSign($out,$key);
        return json_encode($out);

    }










    public function sendAliyunSms($mobile, $code)
    {
        $params = array ();
        // 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = config('msgsetting.aliyunmsgid');
        $accessKeySecret = config('msgsetting.aliyunmsgkey');
        //  必填: 短信接收号码
        $params["PhoneNumbers"] = $mobile;
        //  必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign  万象云端
        $params["SignName"] = config('msgsetting.aliyunmsgsignname');
        //  必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = config('msgsetting.aliyunmsgTempId');
        //  可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = Array (
            "code" => $code
        );
        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        $helper = new SignatureHelper();
        try{
            $content = $helper->request(
                $accessKeyId,
                $accessKeySecret,
                "dysmsapi.aliyuncs.com",
                array_merge($params, array(
                    "RegionId" => "cn-zhongshan",
                    "Action" => "SendSms",
                    "Version" => "2017-05-25",
                ))
            //  选填: 启用https
            // ,true
            );
            $content = (array)$content;
            if($content['Message']=='OK'){
                return json('success');
            } else {
                return json_encode($content,JSON_UNESCAPED_UNICODE);
            }
        }   catch (Exception $ex) {
            throw  $ex;
        }
    }

    public function getUser()
    {
        $request = Request::instance();
        $token = $request->header('token');
        $params = $request->param();
        //$this->checkToken($token);
        $out['return_code'] = 0;
        $out['msg'] = 'success';
        $out['data'] = $params;
        return json_encode($out);
    }

    public function getUser2()
    {
        $out['return_code'] = 300;
        $out['msg'] = '这是封装接口返回的数据';
        $out['data'] = [
            'name' => 'hello',
            'age' => 'world',
            'city'=>'beijing'
        ];
        return json_encode($out);
    }

}