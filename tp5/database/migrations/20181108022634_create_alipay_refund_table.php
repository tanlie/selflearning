<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateAlipayRefundTable extends Migrator
{

    public function up()
    {
        $table = $this->table('alipay_refund');
        $table->setId('iden_id');
        $table->addColumn('out_trade_no','string',['comment'=>'商户ID']);
        $table->addColumn('buyer_user_id','string',['null'=>true,'comment'=>'sub_mch_id']);
        $table->addColumn('buyer_logon_id','string',['comment'=>'微信支付订单号']);
        $table->addColumn('refund_fee','string',['comment'=>'微信退款订单号']);
        $table->addColumn('send_back_fee','string',['comment'=>'现金']);
        $table->addColumn('fund_change','string',['comment'=>'总价']);
        $table->addColumn('code','string',['comment'=>'退款金额']);
        $table->addColumn('msg','string',['comment'=>'退款现金']);
        $table->addColumn('gmt_refund_pay','string',['comment'=>'退款现金']);
        $table->addColumn('trade_no','string',['comment'=>'退款现金']);
        $table->addColumn('create_time','string',['comment'=>'退款现金']);
        $table->save();
    }
    public function down()
    {
        //
    }
}
