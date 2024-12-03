<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SendotpNotify;

class ForgotPasswordController extends Controller
{


    public $otp2;
    public function __construct()
    {
        $this->otp2 = new Otp;
    }

    public function showEmailForm(){
        return view('admin.auth.passwords.email');
    }

    public function sendotp(Request $request){
        $request->validate(['email'=>['required','email']]);
        $admin = Admin::where('email',$request->email)->first();

        if(!$admin){
            return redirect()->back()->withErrors(['email'=>'Try again latter!']);
        }
        $admin->notify(new SendotpNotify());
        return redirect()->route('admin.password.showotpForm',['email'=>$admin->email]);


    }
    public function showotpForm($email){
      return view('admin.auth.passwords.confirm',['email'=>$email]);
    }

    public function verifyotp(Request $request){
        $request->validate([
            'email'=>['required','email'],
            'token'=>['required','min:5']
        ]);
       $otp = $this->otp2->validate($request->email,$request->token);
       
       if($otp->status == false){
             return redirect()->back()->withErrors(['token'=>'Code is invalid!']);
       }
       return redirect()->route('admin.password.resetForm',['email'=>$request->email]);
    }
}
