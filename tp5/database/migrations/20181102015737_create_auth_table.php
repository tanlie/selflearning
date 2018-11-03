<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateAuthTable extends Migrator
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
       $table = $this->table('auth');
       $table->setId('auth_id');
       $table->setPrimaryKey('auth_id');
       $table->addColumn('auth_name','string',['limit'=>30,'default'=>'商户']);
       $table->addColumn('scope','integer',['limit'=>30,'default'=>'1']);
       $table->addColumn('last_modify','string',['null'=>true,'comment'=>'最新修改时间']);
       $table->addColumn('delete_time','timestamp',['null'=>true,'comment'=>'软删除时间']);
       $table->save();
    }



    public function down()
    {
      //
    }


}
