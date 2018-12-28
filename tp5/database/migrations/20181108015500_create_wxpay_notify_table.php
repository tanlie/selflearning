<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateWxpayNotifyTable extends Migrator
{
 
    public function up()
    {
        $table = $this->table('wxpay_notify');
        $table->setId('iden_id');
        $table->addColumn('mch_id','string',['comment'=>'商户ID']);
        $table->addColumn('attach','string',['null'=>true,'comment'=>'支付是后的附加信息']);
        $table->addColumn('out_trade_no','string',['comment'=>'微信支付订单号']);
        $table->addColumn('cash_fee','float',['comment'=>'营收比例']);
        $table->addColumn('total_fee','float',['comment'=>'全部总收入']);
        $table->addColumn('bank_type','string',['null'=>true,'comment'=>'支付银行']);
        $table->addColumn('fee_type','string',['null'=>true,'comment'=>'货币类别']);
        $table->addColumn('is_subscribe','string',['null'=>true,'comment'=>'是否关注公众号']);
        $table->addColumn('result_code','string',['null'=>true,'comment'=>'结果']);
        $table->addColumn('return_code','string',['null'=>true,'comment'=>'返回信息']);
        $table->addColumn('trade_type','string',['null'=>true,'comment'=>'交易类别']);
        $table->addColumn('appid','string',['null'=>true,'comment'=>'appid']);
        $table->addColumn('openid','string',['null'=>true,'comment'=>'openid']);
        $table->addColumn('sign','string',['null'=>true,'comment'=>'sign']);
        $table->addColumn('nonce_str','string',['null'=>true,'comment'=>'nonce_str']);
        $table->addColumn('transaction_id','string',['null'=>true,'comment'=>'transaction_id']);
        $table->addColumn('time_end','string',['null'=>true,'comment'=>'time_end']);
        $table->addColumn('create_time','string',['null'=>true,'comment'=>'create_time']);
        $table->addColumn('update_time','string',['null'=>true,'comment'=>'update_time']);
        $table->addColumn('delete_time','string',['null'=>true,'comment'=>'delete_time']);
        $table->addColumn('sub_mch_id','string',['null'=>true,'comment'=>'sub_mch_id']);
        $table->addColumn('coupon_count','string',['null'=>true,'comment'=>'coupon_count']);
        $table->addColumn('coupon_fee','string',['null'=>true,'comment'=>'coupon_fee']);
        $table->addColumn('coupon_fee_0','string',['null'=>true,'comment'=>'coupon_fee_0']);
        $table->addColumn('coupon_id_0','string',['null'=>true,'comment'=>'coupon_id_0']);
        $table->addColumn('trade_state_desc','string',['null'=>true,'comment'=>'trade_state_desc']);
        $table->addColumn('device_info','string',['null'=>true,'comment'=>'device_info']);
        $table->save();
    }


    public function down()
    {
        //
    }
}
