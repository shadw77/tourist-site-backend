<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Auth;
use App\Traits\GeneralTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use GeneralTrait;

    public function login(Request $request){
        try {
            //return $request;

            //if no errors start make tokens
            $credentials = $request->only(['email', 'password']);//get email,password from request
            $token =   Auth::guard('api')->attempt($credentials);//save credentials in session  generate tokens
            //return $token;
            if (!$token)
                return $this->returnError('data is incorrect','E001');

            $users =  Auth::guard('api')->user();//get credentials data from session admin-api
            $users->api_token = $token;//insert into admin new property
            //return token
            return $this->returnData('users', $users,'user found');

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function logout(Request $request)
    {
         $token = $request -> header('authorization');//get token from header request

        if($token){
            try {

                JWTAuth::setToken($token)->invalidate(); //make token destroy and logout
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError('','some thing went wrongs');
            }
            return $this->returnSuccessMessage('Logged out successfully');
        }else{
            $this -> returnError('','some thing went wrongs');
        }

    }

}
