<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateDevicesTable extends Migrator
{
    public function up()
    {
        $table = $this->table('devices');
        $table->addColumn('device_id','string',['comment'=>'设备ID']);
        $table->addColumn('sort_id','string',['null'=>true,'comment'=>'设备类别ID']);
        $table->addColumn('param_id','string',['comment'=>'设备参数']);
        $table->addColumn('mch_id','string',['comment'=>'商户ID']);
        $table->addColumn('device_name','string',['comment'=>'设备名称']);
        $table->addColumn('device_desc','string',['comment'=>'设备描述']);
        $table->addColumn('goods_lists','string',['comment'=>'非会员套餐']);
        $table->addColumn('mem_goods_lists','string',['comment'=>'会员套餐']);
        $table->addColumn('active','string',['comment'=>'是否激活']);
        $table->addColumn('net_last_time','string',['comment'=>'最近心跳时间']);
        $table->addColumn('net_last_out','string',['comment'=>'心跳间隔']);
        $table->save();
    }
}
