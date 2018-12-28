<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateDeviceSortTable extends Migrator
{
    public function up()
    {
        $table = $this->table('device_sort');
        $table->setId('iden_id');
        $table->addColumn('sort_id','string',['comment'=>'设备ID']);
        $table->addColumn('sort_name','string',['null'=>true,'comment'=>'设备类别ID']);
        $table->addColumn('sort_desc','string',['comment'=>'设备参数']);
        $table->save();
    }
    public function down()
    {
       //
    }
}
