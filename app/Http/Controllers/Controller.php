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
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Redirect;
use Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsEmail;

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
            'mobile' => 'required|max:11|unique:users',
            'password' => 'required|max:9',
        ];

        $messages=[
            "required"          =>  "This Field Is Required",
            "string"            =>  "This Field Must Be String",
            "mobile.max"        =>  "This Field Maximum 11 Characters",
            "password.max"      =>  "This Field Maximum 9 Characters",
            "unique"            =>   "This Field Is Already Taken"
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
            "street" => $request->street,
            "mobile" =>$request->mobile,
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
            'password' => 'required|max:9',
        ];

        $messages=[
            "required"          =>  "This Field Is Required",
            "max"               =>  "This Field Maximun 9 Characters",
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
         //return $token;
         if($token){
            try {
                JWTAuth::invalidate(JWTAuth::getToken());
                return $this->returnSuccessMessage('Logged out successfully',200);

                //JWTAuth::setToken($token)->invalidate(); //make token destroy and logout
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError($e->getMessage(), 400);
            }
        }else{
           return  $this -> returnError('Token Not Provided',400);
        }
    }
    /*end logout function*/

    /*start login with github function*/
    public function githubLogin(){
        return Socialite::driver('github')->stateless()->redirect();
    }
    public function githubredirect(){
        $githubUser = Socialite::driver('github')->stateless()->user();
        $user = User::where("email", $githubUser->email)->first();
        if(! $user){
                $user = User::updateOrCreate([
                'github_id' => $githubUser->id,
            ], [
                'name' => $githubUser->name,
                'email' => $githubUser->email,
                'password'=> null,
                "government"=>'null',
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken,
            ]);
        }
        $token = auth('api')->login($user);
        $user->api_token = $token;
        $response=response()->json([
            'status' => 200,
            'mssg' => "User Has Successfully Logged",
            "userdata" => $user
        ]);
        $redirectUrl = 'http://localhost:4200/?response='.urlencode(json_encode($response));
        return Redirect::away($redirectUrl);
    }
    /*end login with github function*/

    /*start login with google function*/
   public function googleLogin(){
    return Socialite::driver('google')->stateless()->redirect();
   }

   public function googleredirect(){
    $googleUser = Socialite::driver('google')->stateless()->user();
    $user = User::where('email', $googleUser->email)->first();
    if (!$user) {
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'password' => null,
            "government"=>'null',
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);
    }

    $token = auth('api')->login($user);
    $user->api_token = $token;


    $response=response()->json([
        'status' => 200,
        'mssg' => "User Has Successfully Logged",
        "userdata" => $user
    ]);

    $redirectUrl = 'http://localhost:4200/?response='.urlencode(json_encode($response));

    return Redirect::away($redirectUrl);
   }
    /*end login with google function*/


   /*start function that send message to admin*/
    public function sendMessage(Request $request){
        //return $this->returnData('request', $request->message,"message sent");

        Mail::to("abd00tarek19@gmail.com")->send(new ContactUsEmail($request));
    }
   /*end function that send message to admin*/




    /*start testing function*/
    public function testdata(Request $request){
        //return $request->header("authorization");
        //return $request;
        $users=User::get();
        return $this->returnData('users', $users,'All Users in database');
    }
    /*end testing function*/

}
