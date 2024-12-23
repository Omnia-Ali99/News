<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required', 'max:50']
        ]);

        $user = User::whereEmail($request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $token = $user->createToken('user_token', [] , now()->addMinutes(value: 60) )->plainTextToken;
            
            return apiResponse(200, 'user loged successfully!', ['token' => $token]);
        }
        return apiResponse(401, 'Credentials Does Not Match');
    }

    public function logout()
    {
        $user = request()->user();
        $user->currentAccessToken()->delete();
        return apiResponse(200,'Token Deleted Successfully!');
    }
}
