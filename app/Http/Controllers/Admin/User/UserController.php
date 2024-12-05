<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sort_by =request()->sort_by ?? 'id';
        $order_by =request()->order_by ?? 'desc';
        $limit_by =request()->limit_by ?? 5;


        $users = User::when(request()->Keyword,function($q){
            $q->where('name','LIKE','%'.request()->Keyword .'%')
            ->orWhere('name','LIKE','%'.request()->Keyword .'%');
        })->when(!is_null(request()->status),function($q){
            $q->where('status',request()->status);
        });

       $users= $users->orderBy( $sort_by , $order_by)->paginate($limit_by);
       
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        ImageManger::deleteImageFormLocal($user->image);
        $user->delete();
        Session::flash('success','user deleted successfully');
        return redirect()->back();
    } 

    public function changeStatus($id){

        $user = User::findOrFail($id);

        if($user->status == 1){
            $user->update([
                'status' =>0
            ]);  
            Session::flash('success','User Blocked Successfully');

        }else{
            $user->update([
                'status' =>1
            ]);
            Session::flash('success','User Active Successfully');
  
        }
        return redirect()->back();

    }
}
