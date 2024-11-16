<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Frontend\NewsSubscriberMail;
use App\Models\NewsSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NewsSubscriberController extends Controller
{
   public function store(Request $request){
    $request->validate([
        'email'=>['required','email','unique:news_subscribers,email,id'],
    ]);
    $NewsSubscribe=NewsSubscriber::create([
      'email'=>$request->email
    ]);
    if(!$NewsSubscribe){
        Session::flash('error','sorry try again later!');
         return redirect()->back();
    }
        Mail::to($request->email)->send(new NewsSubscriberMail());
        
        Session::flash('success','Thanks for subscribe!');
        return redirect()->back();
   
    
   }
}
