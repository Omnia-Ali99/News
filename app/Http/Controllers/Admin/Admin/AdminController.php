<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Authorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('can:admins');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->sort_by ?? 'id';
        $order_by = request()->order_by ?? 'desc';
        $limit_by = request()->limit_by ?? 5;


        $admins = Admin::where('id','!=', Auth::guard('admin')->user()->id)->when(request()->Keyword, function ($q) {
            $q->where('name', 'LIKE', '%' . request()->Keyword . '%')
                ->orWhere('email', 'LIKE', '%' . request()->Keyword . '%')
                ->orWhere('username', 'LIKE', '%' . request()->Keyword . '%');

        })->when(!is_null(request()->status), function ($q) {
            $q->where('status', request()->status);
        });

        $admins = $admins->orderBy($sort_by, $order_by)->paginate($limit_by);

        return view('admin.admins.index', compact('admins'));
    }
    public function changeStatus($id)
    {

        $admin = Admin::findOrFail($id);

        if ($admin->status == 1) {
            $admin->update([
                'status' => 0
            ]);
            Session::flash('success', 'Admin Blocked Successfully');
        } else {
            $admin->update([
                'status' => 1
            ]);
            Session::flash('success', 'Admin Active Successfully');
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authorizations =Authorization::select('id','role')->get();
        return view('admin.admins.create',compact('authorizations'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->except(['_token']));
        if(!$admin){
            return redirect()->back()->with('error',value: 'Try Again Latter!');
        }
        return redirect()->back()->with('success',value: 'admin created successfully');

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
        $admin =Admin::findOrFail($id);
        $authorizations =Authorization::select('id','role')->get();
        return view('admin.admins.update',compact('authorizations','admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $admin = Admin::findOrFail($id);
        
        if($request->password){
            $admin = $admin->update($request->except(['_token' ,'password_confirmation']));
        }else{
            $admin = $admin->update($request->except(['_token' ,'password','password_confirmation']));
        }
        if(!$admin){
            return redirect()->back()->with('error',value: 'Try Again Latter!');
        }
        return redirect()->back()->with('success',value: 'admin updated successfully');   
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        Session::flash('success', 'admin deleted successfully');
        return redirect()->route('admin.admins.index');
    }
}
