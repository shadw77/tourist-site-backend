<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class chagePasswordController extends Controller
{
    use GeneralTrait;

    /*start function taht recieve from response request component and validte it */
    public function process(Request $request){

        $rules=[
            'email' => 'required|email|exists:users',
            'password' => 'required|max:9',
        ];

        $messages=[
            "required"          =>  "This Field Is Required",
            "string"            =>  "This Field Must Be String",
            "password.max"      =>  "This Field Maximum 9 Characters",
            "exists"            =>   "This Field Should Exist"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->returnData("error",$validator->errors(),"There Is Some Errors", 400);
        }

        if($this->getPasswordResetTableRow($request)->count() > 0){
            return $this->changePassword($request);
        }
        else{
            return $this->returnError("Either your email or token is wrong.",401);
        }
    }
    /*end function taht recieve from response request component and validte it */

    /*start function that recieve request from process to check  if email and token exists in db */
    private function getPasswordResetTableRow($request){
        return DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ]);
    }
    /*end function that recieve request from process to check  if email and token exists in db */

    /*start function that recieve request from process and update pssword and delete record from password_resets table*/
    private function changePassword($request) {
        // find email
        $userData = User::whereEmail($request->email)->first();

        // update password
        $userData->update([
        'password'=>bcrypt($request->password)
        ]);
        $this->getPasswordResetTableRow($request)->delete();
        // remove verification data from db
        // reset password response
        return $this->returnSuccessMessage("Password has been updated.",200);
    }
    /*end function that recieve request from process and update pssword and delete record from password_resets table*/
}
