<?php

namespace App\Http\Controllers\Admin\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function __construct(){
        $this->middleware('can:notification');
    }
    
    public function index(){
        Auth('admin')->user()->unreadNotifications->markAsRead();
        $notifications = Auth('admin')->user()->notifications()->get();
        return view('admin.notification.index', compact('notifications'));
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
