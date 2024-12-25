<?php

namespace App\Http\Controllers\Api\Auth;

use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SendOtpVerifyUserEmail;

class VerifyEmailController extends Controller
{
    public $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function verifyEmail(Request $request){

        $request->validate(['token'=>['required','min:5']]);
        

        $user =$request->user();

        $otp2 = $this->otp->validate($user->email,$request->token);
       
        if($otp2->status == false){
            return apiResponse(400,'Code is invalid!');
        }

        $user->update(['email_verified_at'=>now()]);
        return apiResponse(200,'Email Verifid Successfully!');
    }

    public function sendOtpAgain(){

        $user =request()->user();
        $user->notify(new SendOtpVerifyUserEmail());
        return apiResponse(200,'Otp Send Successfully!');


    }
}
