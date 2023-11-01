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
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use GeneralTrait;

    /*start register function*/
    public function register(Request $request){
        //return $request;
        // Validate the request data
        $rules=[
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:4',
        ];

        $messages=[
            "required"          =>  "This Field Is Required",
            "string"            =>  "This Field Must Be String",
            "max"               =>  "This Field Minimum 4 Characters",
            "unique"            =>   "This Email Is Already Taken"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->returnError($validator->errors(), 400);
        }

        // Create a new user
        $id = User::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            "government" => $request->government,
        ]);

        $user=User::find($id);

        $token = Auth::guard('api')->attempt($request->only('email', 'password'));
        $user->api_token = $token;
        // Return a response with the new user's data and token
        return $this->returnData('userdata', $user,'User Has Successfully Registered');

    }
    /*end register function*/

    /*start login function*/
    public function login(Request $request){
        try {
            //return $request;
        // Validate the request data
        $rules=[
            'email' => 'required|email|exists:users',
            'password' => 'required|max:4',
        ];

        $messages=[
            "required"          =>  "This Field Is Required",
            "max"               =>  "This Field Minimum 4 Characters",
            "exists"            =>   "This Email Is Not Exists"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->returnError($validator->errors(), 400);
        }

            //if no errors start make tokens
            $credentials = $request->only(['email', 'password']);//get email,password from request
            $token =   Auth::guard('api')->attempt($credentials);//save credentials in session  generate tokens
            //return $token;
            if (!$token)
                return $this->returnError('data is incorrect',401);

            $users =  Auth::guard('api')->user();//get credentials data from session admin-api
            $users->api_token = $token;//insert into admin new property
            //return token
            return $this->returnData('userdata', $users,'User Has Successfully Logged',200);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    /*end login function*/

    /*start logout function*/
    public function logout(Request $request)
    {

         $token = $request -> header('Authorization');//get token from header request

        if($token){
            try {

                JWTAuth::setToken($token)->invalidate(); //make token destroy and logout
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                $this -> returnError('some thing went wrongs',400);
            }
            return $this->returnSuccessMessage('Logged out successfully',200);
        }else{
            $this -> returnError('Token Not Provided',400);
        }

    }
    /*end logout function*/


    /*start testing function*/
    public function testdata(){
        $users=User::get();
        return $this->returnData('users', $users,'All Users in database');
    }
    /*end testing function*/

}
