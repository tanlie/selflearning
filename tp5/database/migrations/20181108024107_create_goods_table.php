<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateGoodsTable extends Migrator
{
    public function up()
    {
        $table = $this->table('goods');
        $table->setId('iden_id');
        $table->setPrimaryKey('iden_id');
        $table->addColumn('goods_id','string',['comment'=>'商品ID']);
        $table->addColumn('goods_name','string',['null'=>true,'comment'=>'sub_mch_id']);
        $table->addColumn('goods_desc','string',['comment'=>'微信支付订单号']);
        $table->addColumn('gooods_basenum','string',['comment'=>'微信退款订单号']);
        $table->addColumn('goods_unit','string',['comment'=>'现金']);
        $table->addColumn('goods_price','string',['comment'=>'总价']);
        $table->addColumn('goods_coin','string',['comment'=>'退款金额']);
        $table->addColumn('goods_ticket','string',['comment'=>'退款现金']);
        $table->addColumn('goods_score','string',['comment'=>'退款现金']);
        $table->addColumn('last_modify','string',['comment'=>'退款现金']);
        $table->save();
    }
}
