<?php

namespace App\Http\Middleware;
use App\Exceptions\ParameterException;
use Closure;
class RegisterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $params = $request->input();
        if(@!$params['user_name']){
          return response()->json(['msg'=>'用户名不能为空','code'=>400]);
        }
        if(@!$params['mobile']){
            return response()->json(['msg'=>'电话号码不能为空','code'=>400]);
        }
        if(@!$params['pass_word']){
            return response()->json(['msg'=>'密码不能为空','code'=>400]);
        }
        return $next($request);
    }
}
