<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateWxpayRefundTable extends Migrator
{
    public function up()
    {
        $table = $this->table('wxpay_refund');
        $table->setId('iden_id');
        $table->addColumn('mch_id','string',['comment'=>'商户ID']);
        $table->addColumn('sub_mch_id','string',['null'=>true,'comment'=>'sub_mch_id']);
        $table->addColumn('out_trade_no','string',['comment'=>'微信支付订单号']);
        $table->addColumn('out_refund_no','string',['comment'=>'微信退款订单号']);
        $table->addColumn('cash_fee','float',['comment'=>'现金']);
        $table->addColumn('total_fee','float',['comment'=>'总价']);
        $table->addColumn('refund_fee','float',['comment'=>'退款金额']);
        $table->addColumn('cash_refund_fee','float',['comment'=>'退款现金']);
        $table->addColumn('coupon_refund_fee','float',['comment'=>'退款现金']);
        $table->addColumn('coupon_refund_count','float',['comment'=>'退款现金']);
        $table->addColumn('result_code','string',['null'=>true,'comment'=>'结果']);
        $table->addColumn('return_code','string',['null'=>true,'comment'=>'返回信息']);
        $table->addColumn('return_msg','string',['null'=>true,'comment'=>'返回信息']);
        $table->addColumn('appid','string',['null'=>true,'comment'=>'appid']);
        $table->addColumn('sign','string',['null'=>true,'comment'=>'sign']);
        $table->addColumn('nonce_str','string',['null'=>true,'comment'=>'nonce_str']);
        $table->addColumn('transaction_id','string',['null'=>true,'comment'=>'transaction_id']);
        $table->addColumn('refund_id','string',['null'=>true,'comment'=>'refund_id']);
        $table->addColumn('refund_channel','string',['null'=>true,'comment'=>'refund_channel']);
        $table->addColumn('create_time','string',['null'=>true,'comment'=>'create_time']);
        $table->addColumn('update_time','string',['null'=>true,'comment'=>'update_time']);
        $table->addColumn('delete_time','string',['null'=>true,'comment'=>'delete_time']);
        $table->save();
    }

    public function down()
    {
      //
    }
}
