<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get('/','admin/Index/index');


/*创建用户*/
Route::post('v1/register','xiaochengxu/UserController/register');
Route::post('v1/login','xiaochengxu/UserController/login');
Route::post('v1/get_msg_code','xiaochengxu/UserController/getMsgCode');
Route::post('v1/is_user','xiaochengxu/UserController/isUser');
Route::post('v1/change_pwd','xiaochengxu/UserController/changePassWord');

/*设备操作*/
Route::post('v1/device_bind','xiaochengxu/DeviceController/deviceBind');
Route::post('v1/device_list','xiaochengxu/DeviceController/deviceList');
Route::post('v1/device_detail','xiaochengxu/DeviceController/deviceDetail');
Route::post('v1/device_info_edit','xiaochengxu/DeviceController/deviceInfoEdit');
Route::post('v1/device_unbind','xiaochengxu/DeviceController/deviceUnbind');



Route::get('getuser','xiaochengxu/UserController/getUser');
Route::get('getuser2','xiaochengxu/UserController/getUser2');
Route::any('getToken','xiaochengxu/TokenController/getToken');
Route::any('verifyToken','xiaochengxu/TokenController/verifyToken');
Route::post('updateUserInfo','xiaochengxu/TokenController/updateUserInfo');
Route::get('socket.io','socket/Index/index');