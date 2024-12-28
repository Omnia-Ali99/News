<?php

namespace App\Http\Controllers\Api\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications(){

         $user = Auth::guard('sanctum')->user();

         $notifications = $user->notifications;
         $unreadnotifications = $user->unreadNotifications;
         return apiResponse(200,'User Notifications',[
            'notifications'=> NotificationResource::collection($notifications),
            'unreadnotifications'=> NotificationResource::collection($unreadnotifications),
         ]);
    }
}
