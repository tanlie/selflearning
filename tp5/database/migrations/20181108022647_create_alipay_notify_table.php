<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateAlipayNotifyTable extends Migrator
{

    public function up()
    {
        $table = $this->table('alipay_notify');
        $table->setId('iden_id');
        $table->addColumn('app_id','string',['comment'=>'商户ID']);
        $table->addColumn('out_trade_no','string',['null'=>true,'comment'=>'支付是后的附加信息']);
        $table->addColumn('total_amount','string',['comment'=>'微信支付订单号']);
        $table->addColumn('body','string',['comment'=>'营收比例']);
        $table->addColumn('subject','string',['comment'=>'全部总收入']);
        $table->addColumn('seller_email','string',['null'=>true,'comment'=>'支付银行']);
        $table->addColumn('seller_id','string',['null'=>true,'comment'=>'货币类别']);
        $table->addColumn('auth_app_id','string',['null'=>true,'comment'=>'是否关注公众号']);
        $table->addColumn('trade_status','string',['null'=>true,'comment'=>'结果']);
        $table->addColumn('receipt_amount','string',['null'=>true,'comment'=>'返回信息']);
        $table->addColumn('buyer_id','string',['null'=>true,'comment'=>'交易类别']);
        $table->addColumn('buyer_logon_id','string',['null'=>true,'comment'=>'appid']);
        $table->addColumn('buyer_pay_amount','string',['null'=>true,'comment'=>'openid']);
        $table->addColumn('invoice_amount','string',['null'=>true,'comment'=>'sign']);
        $table->addColumn('point_amount','string',['null'=>true,'comment'=>'nonce_str']);
        $table->addColumn('fund_bill_list','string',['null'=>true,'comment'=>'transaction_id']);
        $table->addColumn('version','string',['null'=>true,'comment'=>'time_end']);
        $table->addColumn('sign_type','string',['null'=>true,'comment'=>'create_time']);
        $table->addColumn('notify_type','string',['null'=>true,'comment'=>'update_time']);
        $table->addColumn('charset','string',['null'=>true,'comment'=>'delete_time']);
        $table->addColumn('notify_id','string',['null'=>true,'comment'=>'sub_mch_id']);
        $table->addColumn('trade_no','string',['null'=>true,'comment'=>'coupon_count']);
        $table->addColumn('gmt_create','string',['null'=>true,'comment'=>'coupon_fee']);
        $table->addColumn('gmt_payment','string',['null'=>true,'comment'=>'coupon_fee_0']);
        $table->addColumn('notify_time','string',['null'=>true,'comment'=>'coupon_id_0']);
        $table->addColumn('delete_time','string',['null'=>true,'comment'=>'trade_state_desc']);
        $table->save();
    }

    public function down()
    {
        //
    }
}
