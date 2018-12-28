<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-05
 * Time: 21:16
 */

namespace app\xiaochengxu\controller;


use app\libs\exception\ParameterException;
use app\xiaochengxu\model\DeviceModel;
use app\xiaochengxu\validate\DeviceListValidate;
use app\xiaochengxu\validate\DeviceRegValidate;
use think\Request;

class DeviceController extends BaseController
{
    public function deviceBind(Request $request)
    {
        $token = $request->header('token');
        $user_id = $this->getUserIdByToken($token);
        $validate = new DeviceRegValidate();
        $validate->goCheck();
        $device = new DeviceModel();
        $device_id = $request->param('device_no');
        $res = $device->device_bind($user_id,$device_id);
        if(!$res){
            throw new ParameterException([
                'msg' => '绑定设备失败~'
            ]);
        }
        $out['return_code'] = 0;
        $out['return_msg'] = 'success';
        $key = $this->key;
        $out['sign'] = SignController::createSign($out,$key);
        return json_encode($out);
    }


    public function deviceList(Request $request)
    {
        $token = $request->header('token');
        $user_id = $this->getUserIdByToken($token);
        (new DeviceListValidate())->goCheck();
        $device = new DeviceModel();
        $data = $device->get_device_list($user_id);
        $out['return_code'] = 0;
        $out['return_msg'] = 'success';
        $out['data'] = $data;
        $key = $this->key;
        $out['sign'] = SignController::createSign($out,$key);
        return json_encode($out);
    }

    public function deviceDetail(Request $request)
    {
        $token = $request->header('token');
        $user_id = $this->getUserIdByToken($token);
        //判断是否有权查看
        $device_id = $request->param('device_id');
        $device = new DeviceModel();
        $data = $device->get_device_detail($device_id);
        $out['return_code'] = 0;
        $out['return_msg'] = 'success';
        $out['data'] = $data;
        $key = $this->key;
        $out['sign'] = SignController::createSign($out,$key);
        return json_encode($out);
    }

    public function deviceInfoEdit(Request $request)
    {
        $token = $request->header('token');
        $user_id = $this->getUserIdByToken($token);
        //判断是否有权查看
        $device = new DeviceModel();
        $device_id = $request->param('device_id');

        $out['return_code'] = 0;
        $out['return_msg'] = 'success';
        $out['data'] = '';
        $key = $this->key;
        $out['sign'] = SignController::createSign($out,$key);
        return json_encode($out);

    }

    public function deviceUnbind(Request $request)
    {
        $token = $request->header('token');
        $user_id = $this->getUserIdByToken($token);
        //判断是否有权查看
        $device = new DeviceModel();
        $device_id = $request->param('device_id');

        $out['return_code'] = 0;
        $out['return_msg'] = 'success';
        $out['data'] = '';
        $key = $this->key;
        $out['sign'] = SignController::createSign($out,$key);
        return json_encode($out);

    }

}