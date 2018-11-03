<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateMachinesTable extends Migrator
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
       $table = $this->table('machines');
       $table->setId('id');
       $table->addColumn('machine_id','string',['limit'=>50, 'default'=>'请填写16进制的ID','comment'=>'16进制的机器ID']);
       $table->addColumn('machine_sort_id','integer',['default'=>1, 'comment'=>'机器类别ID']);
       $table->addColumn('machine_name','string',['limit'=>100, 'default'=>'请填写机器名称','comment'=>'机器名称']);
       $table->addColumn('goods_id','string',['limit'=>50, 'default'=>'请选择套餐ID','comment'=>'套餐ID']);
       $table->addColumn('machine_desc','string',['limit'=>255,'default'=>'请输入设备描述信息','null'=>true,'comment'=>'机器ID']);
       $table->addColumn('mch_id','integer',['comment'=>'商户ID','null'=>true]);
       $table->addColumn('agent_id','integer',['comment'=>'代理商ID','null'=>true]);
       $table->addColumn('active_status','integer',['comment'=>'设备激活状态','default'=>0]);
       $table->addColumn('running_status','integer',['comment'=>'设备运行状态','default'=>1]);
       $table->addColumn('net_time_out','integer',['default'=>120,'comment'=>'心跳间隔']);
       $table->addColumn('last_net_time','string',['null'=>true,'comment'=>'最近心跳时间']);
       $table->addColumn('create_time','string',['null'=>true,'comment'=>'添加时间']);
       $table->addColumn('delete_time','timestamp',['null'=>true,'comment'=>'软删除时间']);
       $table->save();
    }

    public function down()
    {

    }


}
