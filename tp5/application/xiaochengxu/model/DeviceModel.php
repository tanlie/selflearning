<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-05
 * Time: 21:25
 */

namespace app\xiaochengxu\model;


class DeviceModel extends BaseModel
{
    protected $name = 'devices';

    public function device_bind($user_id,$device_id)
    {

        return true;
    }

    public function get_device_list($user_id)
    {
        $data[0] = [
            'device_name' =>'拳皇97',
            'device_id' => '66600241',
            'device_status' =>1
        ];
        $data[1] = [
            'device_name' =>'拳皇98',
            'device_id' => '66600369',
            'device_status' =>1
        ];
        $data[2] = [
            'device_name' =>'拳皇99',
            'device_id' => '66600EE5',
            'device_status' =>1
        ];
        return $data;
    }

    public function get_device_detail($device_id)
    {
        return true;
    }

}