<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index(){
        auth()->user()->unreadNotifications->markAsRead();
        return view('frontend.dashboard.notification');
    }
    public function delete(Request $request){
        
       $notification = auth()->user()->notifications()->where('id',$request->notify_id)->first();
       if(!$notification){
        Session::flash('error','Notification not found');
        return redirect()->back();
 
       }
       $notification->delete();
       Session::flash('success','Notification Deleted');
       return redirect()->back();


    }

    public function deleteAll(){

        auth()->user()->notifications()->delete();
        Session::flash('success','All Notification Deleted');
        return redirect()->back();

    }
}
