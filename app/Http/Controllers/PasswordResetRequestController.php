<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use App\Traits\GeneralTrait;


class PasswordResetRequestController extends Controller {

    use GeneralTrait;

    /*start function that validate request reset comonent and send email*/
    public function sendPasswordResetEmail(Request $request){
        // If email does not exist
        $rules=['email' => 'required|email|exists:users',];

        $messages=[
            "required"          =>  "This Field Is Required",
            "exists"            =>   "This Email Is Not Exists"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            return $this->returnData("error",$validator->errors(),"There Is Some Errors", 400);

        }
         else {
            // If email exists
            //return $request;
            $this->sendMail($request->email);

            return $this->returnSuccessMessage('Check your inbox, we have sent a link to reset email.',200);
        }
    }
    /*end function that validate request reset comonent and send email*/

    /*start function that recieve email from sendPasswordResetEmail function and send emai*/
    public function sendMail($email){
        $token = $this->createToken($email);
        Mail::to($email)->send(new ResetPasswordMail($token));
    }
    /*end function that recieve email from sendPasswordResetEmail function and send emai*/

    /*start function that recieve email from sendPasswordResetEmail function and check if email exist and  generate random function*/
    public function createToken($email){
      $oldToken = DB::table('password_resets')->where('email', $email)->first();
      if($oldToken) {
        return $oldToken;
      }
      $token = Str::random(60);;
      $this->storeToken($token, $email);
      return $token;
    }
    /*end function that recieve email from sendPasswordResetEmail function and check if email exist and  generate random function*/


    /* start function that recieve email , token from createtoken function and store them in password_resets table store it in password_resets table*/
    public function storeToken($token, $email){
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }
    /* end function that recieve email , token from createtoken function and store them in password_resets table store it in password_resets table*/


}
