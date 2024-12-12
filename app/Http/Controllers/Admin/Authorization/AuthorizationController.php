<?php

namespace App\Http\Controllers\Admin\Authorization;

use Illuminate\Http\Request;
use App\Models\Authorization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AuthorizationRequest;

class AuthorizationController extends Controller
{

    public function __construct(){
        $this->middleware('can:authorizations');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authorizations = Authorization::paginate(5);
        return view('admin.authorizations.index',compact('authorizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.authorizations.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorizationRequest $request)
    {
       $request->validated();
       $authorization = new Authorization();
       $this->roles($authorization,$request);
       return redirect()->back()->with('success','Role Created Successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $authorization = Authorization::findOrFail($id);
        return view('admin.authorizations.edit',compact('authorization'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $authorization = Authorization::findOrFail($id);
        $this->roles($authorization,$request);
        return redirect()->route('admin.authorizations.index')->with('success','Role Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Authorization::findOrFail($id);
        if($role->admins->count()>0){
            return redirect()->back()->with('error','Please Delete Related Admin First');
        }
        $role = $role->delete();
        if(!$role){
            return redirect()->back()->with('error','try again latter!');

        }
        return redirect()->back()->with('success','Role Deleted Successfully!');

    }

private function roles($authorization ,$request){
    $authorization->role =$request->role;
    $authorization->permissions = json_encode($request->permissions);
    $authorization->save();
}
}
