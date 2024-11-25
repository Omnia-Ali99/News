<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Models\User;
use App\Utils\ImageManger;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Frontend\SettingRequest;

class SettingController extends Controller
{
    public function index(){

        $user = auth()->user();

        return view('frontend.dashboard.setting',compact('user'));
    }
    public function update(SettingRequest $request){
      
        $request->validated();
        $user = User::findOrFail(auth()->user()->id);
        $user->update($request->except(['_token','image']));

        ImageManger::uploadImages($request,null,$user);

        return redirect()->back()->with('success','Profile Date Updated Successfully !');  


    }
    public function ChangePassword(Request $request){
        $request->validate([
            "current_password"=>['required'],
            "password"=>['required','confirmed'],
            "password_confirmation"=>['required'],
            ]);
        
    if(!Hash::check($request->current_password ,auth()->user()->password)){
        return redirect()->back()->with('error','Password does not match');  
    }
    $user = User::findOrFail(auth()->user()->id);
    $user->update([
          "password"=>Hash::make($request->password)
        ]);
      return redirect()->back()->with('success','Your Password changed Successfully');  


    }
}
