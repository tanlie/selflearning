<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateUsersTable extends Migrator
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
       $table = $this->table('users');
       $table->setId('user_id');
       $table->addColumn('user_name','string',['limit'=>50, 'default'=>'佚名','comment'=>'用户名']);
       $table->addColumn('pass_word','string',['limit'=>'100','comment'=>'密码']);
       $table->addColumn('mobile','string',['limit'=>'20','comment'=>'电话号码']);
       $table->addColumn('user_addr','string',['null'=>true,'comment'=>'用户地址']);
       $table->addColumn('user_email','string',['limit'=>50,'null'=>true,'comment'=>'用户邮箱']);
       $table->addColumn('openid','string',['limit'=>50, 'null'=>true,'comment'=>'微信openid']);
       $table->addColumn('unionid','string',['limit'=>50,'null'=>true,'comment'=>'微信平台ID']);
       $table->addColumn('session_key', 'string',['limit'=>50, 'null'=>true,'comment'=>'小程序session_key']);
       $table->addColumn('auth_id','integer',['limit'=>2, 'default'=>1, 'comment'=>'用户权限,见权限表']);
       $table->addColumn('create_time','string',['null'=>true,'comment'=>'用户创建时间']);
       $table->addColumn('last_modify','string',['null'=>true,'comment'=>'最新修改时间']);
       $table->addColumn('last_login_time','string',[ 'null'=>true,'comment'=>'最近登录时间']);
       $table->addColumn('login_count','integer',[ 'default'=>1,'comment'=>'用户登录次数统计']);
       $table->addColumn('delete_time','timestamp',['null'=>true,'comment'=>'软删除时间']);
       $table->save();
    }

    public function down()
    {

    }

}
