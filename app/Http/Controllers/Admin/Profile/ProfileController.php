<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
  
    public function __construct(){
        $this->middleware('can:profile');
    }
    public function index()
    {
        return view('admin.profile.index');
    }
    public function update(Request $request)
    {
        $request->validate($this->filterData());
        $admin = Admin::findOrFail(auth('admin')->user()->id);
        if (!Hash::check($request->password, $admin->password)) {
            Session::flash('error','sorry not update profile data');
            return redirect()->back();
        }
        $admin->update(attributes: $request->except(['password','_token']));
        Session::flash('success','profile updated successfully');
        return redirect()->back();
    }
    private function filterData()
    {
        return  [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:admins,username,' . auth('admin')->user()->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . auth('admin')->user()->id],
            'password' => ['required'],
        ];
    }
}
