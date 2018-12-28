<?php

namespace App\Http\Controllers\mina;

use App\Http\Controllers\Controller;
use App\Http\Model\AgentModel;
use App\Http\Model\SysParamsModel;
use App\Http\Model\UsersModel;
use Illuminate\Http\Request;
use DB;

class AgentController extends Controller
{
    public function agentRegister(Request $request)
    {
        $params = $request->input();
        /*查看是否已经注册成为了服务商*/
        $check = UsersModel::with(['agent'])->whereMobile($params['mobile'])->first();
        if($check && $check->agent){
            return response()->json(['code'=>400,'msg'=>'该服务商已经注册，请勿重复注册~','data'=>[]]);
        }
        try{
            DB::beginTransaction();
            if(!$check){
                /*还没注册用户*/
                $user_id = $this->createNewUser($params);
                $this->createNewAgent($user_id);
            } else if(!$check->agent){
                /*已经注册了用户，还没成为服务商*/
                $this->createNewAgent($check->user_id);
            }
            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        $out['token'] = md5(time());
        return response()->json(['code'=>200,'msg'=>'success','data'=>$out]);
    }


    private function createNewAgent($user_id)
    {
        $agent = new AgentModel();
        $agent->user_id = $user_id;
        $agent->percent = SysParamsModel::whereName('agent')->value('per_default');
        $agent->agent_status = 0;
        $agent->income = 0;
        $agent->withdraw = 0;
        $agent->save();
    }


}
