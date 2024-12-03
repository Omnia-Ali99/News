<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    public function showResetForm($email){
      return view('admin.auth.passwords.reset',['email'=>$email]);
    }

    public function resetPassword(Request $request){
       $request->validate($this->filterData());
       $admin = Admin::where('email',$request->email)->first();

       if(!$admin){
        return redirect()->back()->with(['error'=>'Try again latter!']);
    }
    $admin->update([
      'password'=>bcrypt($request->password),
    ]);
    return redirect()->route('admin.login.show')->with('success','Your Password Updated Successfully');
} 

private function filterData(){
    return [
        'email'=>['required','email'],
        'password'=>['required','confirmed','min:8'],
    ];
}
}