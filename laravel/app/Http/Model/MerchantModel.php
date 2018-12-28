<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-28
 * Time: 23:47
 */

namespace App\Http\Model;


class MerchantModel extends BaseModel
{
    protected $table = 'merchants';
    const UPDATED_AT = 'last_modify';
    const CREATED_AT = 'create_time';
    protected $primaryKey = 'mch_id';


}