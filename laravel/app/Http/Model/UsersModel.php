<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'last_modify';
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    public function agent()
    {
        return $this->hasOne('App\Http\Model\AgentModel','user_id');
    }

    public function merchant()
    {
        return $this->hasOne('App\Http\Model\MerchantModel','user_id');
    }




}
