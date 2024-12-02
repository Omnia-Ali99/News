<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('admin.auth.login');

    }

    public function checkAuth(Request $request){
        $request->validate($this->filterData());

        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            return redirect()->intended(RouteServiceProvider::AdminHome);
        }
           return redirect()->back()->withErrors(['email'=>'credentials dose not match!']);



    }

    private function filterData(){
        return [
            'email'=>['required','email'],
            'password'=>['required','min:8'],
            'remember'=>['in:on,of'],
        ];
    }
}
