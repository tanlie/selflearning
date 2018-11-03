<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateMachineSortTable extends Migrator
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
        $table = $this->table('machine_sort');
        $table->setId('sort_id');
        $table->addColumn('machine_sort_id','integer',['default'=>101,'comment'=>'设备分类ID']);
        $table->addColumn('sort_name','string',['default'=>'请输入分类名称','comment'=>'设备分类ID']);
        $table->addColumn('sort_desc','string',['default'=>'请输入分类描述','comment'=>'设备描述']);
        $table->addColumn('last_modify','string',['null'=>true,'comment'=>'设备描述']);
        $table->addColumn('delete_time','timestamp',['null'=>true,'comment'=>'软删除时间']);
        $table->save();
    }

    public function down()
    {

    }
}
