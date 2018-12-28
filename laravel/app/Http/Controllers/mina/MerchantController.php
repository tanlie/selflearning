<?php

namespace App\Http\Controllers\mina;

use App\Http\Controllers\Controller;
use App\Http\Model\MerchantModel;
use App\Http\Model\SysParamsModel;
use App\Http\Model\UsersModel;
use Illuminate\Http\Request;
use DB;

class MerchantController extends Controller
{
    public function merchantRegister(Request $request)
    {
        $params = $request->input();
        $mch_user = UsersModel::with(['merchant'])->whereMobile($params['mobile'])->first();
        if($mch_user && $mch_user->merchant){
            return response()->json(['code'=>400,'msg'=>'号码已被注册','data'=>[]]);
        }
        if(@!$params['agent_id']){
            return response()->json(['code'=>400,'msg'=>'请填写服务商邀请码','data'=>[]]);
        }
        $agent_user = UsersModel::with(['agent'])->whereMobile($params['agent_id'])->first();

        if(!$agent_user || !$agent_user->agent){
            return response()->json(['code'=>400,'msg'=>'请填写正确的服务商邀请码','data'=>[]]);
        }
        try{
            DB::beginTransaction();
            if(!$mch_user){
                $user_id = $this->createNewUser($params);
                $this->createNewMerchant($user_id,$agent_user->agent->agent_id);
            } else {
                $this->createNewMerchant($mch_user->user_id,$agent_user->agent->agent_id);
            }
            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        return response()->json(['code'=>200,'msg'=>'success','data'=>[]]);
    }


    private function createNewMerchant($user_id,$agent_id)
    {
        $merchant = new MerchantModel();
        $merchant->user_id = $user_id;
        $merchant->percent = SysParamsModel::whereName('merchant')->value('per_default');
        $merchant->agent_id = $agent_id;
        $merchant->income = 0;
        $merchant->withdraw = 0;
        $merchant->mch_status = 1;
        $merchant->save();
        return $merchant->mch_id;
    }

}
