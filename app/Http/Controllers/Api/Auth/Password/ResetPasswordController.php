<?php

namespace App\Http\Controllers\Api\Auth\Password;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
       
        $otp2 = $this->otp->validate($request->email, $request->token);

        if ($otp2->status == false) {
            return apiResponse(400, 'Code is invalid!');
        }
        
        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            return apiResponse(404, 'User Not Found!');
        }
        $user->update([
            'password' =>Hash::make($request->password)
        ]);
        return apiResponse(200, 'Password Updated Successfully!');
    }
}
