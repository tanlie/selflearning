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

/*创建用户*/
Route::post('createUser','xiaochengxu/UserController/createUser');





Route::get('getuser','xiaochengxu/UserController/getUser');
Route::get('getuser2','xiaochengxu/UserController/getUser2');


Route::any('getToken','xiaochengxu/TokenController/getToken');
Route::any('verifyToken','xiaochengxu/TokenController/verifyToken');
Route::post('updateUserInfo','xiaochengxu/TokenController/updateUserInfo');