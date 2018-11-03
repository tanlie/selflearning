<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateMachineGoodsTable extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $table = $this->table('machine_goods');
        $table->setId('id');
        $table->addColumn('goods_id','string',['limit'=>50, 'default'=>'请输入MD5加密大写GOODS','comment'=>'商品套餐ID']);
        $table->addColumn('goods_name','string',['limit'=>100,'comment'=>'套餐名称']);
        $table->addColumn('goods_desc','string',['comment'=>'套餐描述']);
        $table->addColumn('goods_price','float',['null'=>true,'default'=>0.01,'comment'=>'商品极货币价格']);
        $table->addColumn('goods_coin','integer',['default'=>1,'comment'=>'商品的代币价格']);
        $table->addColumn('goods_ticket','integer',['default'=>0, 'null'=>true,'comment'=>'商品彩票价格']);
        $table->addColumn('goods_score','integer',['default'=>0,'null'=>true,'comment'=>'商品积分价格']);
        $table->addColumn('goods_basenum','integer',['default'=>1,'comment'=>'套餐基础数据']);
        $table->addColumn('goods_present','integer',['default'=>0,'comment'=>'赠送数量']);
        $table->addColumn('create_time','string',['null'=>true, 'comment'=>'用户创建时间']);
        $table->addColumn('last_modify','string',['null'=>true,'comment'=>'最新修改时间']);
        $table->addColumn('delete_time','timestamp',['null'=>true,'comment'=>'软删除时间']);
        $table->save();
    }
}
