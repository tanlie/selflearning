<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateAgentsTableble extends Migrator
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
        $table = $this->table('agents');
        $table->addColumn('mch_id','integer',['comment'=>'关联设备表中的ID']);
        $table->addColumn('user_id','integer',['comment'=>'关联用户表中的ID']);
        $table->addColumn('agent_id','integer',['comment'=>'关联代理表中的ID']);
        $table->addColumn('agent_status','integer',['comment'=>'代理商审核状态']);
        $table->addColumn('agent_proportion','float',['comment'=>'营收比例']);
        $table->addColumn('income','float',['default'=>0,'comment'=>'全部总收入']);
        $table->addColumn('last_modify','string',['null'=>true,'comment'=>'最新修改时间']);
        $table->save();
    }
}
