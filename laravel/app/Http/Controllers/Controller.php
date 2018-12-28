<?php

namespace App\Http\Controllers;

use App\Http\Model\UsersModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

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
