<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-28
 * Time: 23:09
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected function createNewUser($params)

    {
        $user = new UsersModel();
        $user->user_name = $params['user_name'];
        $user->pass_word = $params['pass_word'];
        $user->mobile = $params['mobile'];
        $user->save();
        return $user->user_id;
    }


}