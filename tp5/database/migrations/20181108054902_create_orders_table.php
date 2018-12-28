<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateOrdersTable extends Migrator
{
    public function up()
    {
        $table = $this->table('orders');
        $table->setId('iden_id');
        $table->addColumn('order_no','string',['comment'=>'订单号']);
        $table->addColumn('device_id','string',['comment'=>'设备ID']);
        $table->addColumn('buyer_openid','string',['comment'=>'微信openid']);
        $table->addColumn('buyer_unionid','string',['comment'=>'微信unionid']);
        $table->addColumn('discount','string',['comment'=>'折扣']);
        $table->addColumn('goods_id','string',['comment'=>'商品ID']);
        $table->addColumn('goods_price','string',['comment'=>'总价']);
        $table->addColumn('goods_coin','string',['comment'=>'代币']);
        $table->addColumn('goods_ticket','string',['comment'=>'奖票']);
        $table->addColumn('goods_score','string',['comment'=>'积分']);
        $table->addColumn('goods_lists','string',['comment'=>'商品统计']);
        $table->addColumn('order_type','string',['comment'=>'订单类型']);
        $table->addColumn('order_status','string',['comment'=>'订单状态']);
        $table->addColumn('order_create_time','string',['comment'=>'订单创建时间']);
        $table->addColumn('order_finished_time','string',['null'=>true,'comment'=>'订单完成时间']);
        $table->save();
    }
}
