<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sort_by = request()->sort_by ?? 'id';
        $order_by = request()->order_by ?? 'desc';
        $limit_by = request()->limit_by ?? 5;


        $users = User::when(request()->Keyword, function ($q) {
            $q->where('name', 'LIKE', '%' . request()->Keyword . '%')
                ->orWhere('name', 'LIKE', '%' . request()->Keyword . '%');
        })->when(!is_null(request()->status), function ($q) {
            $q->where('status', request()->status);
        });

        $users = $users->orderBy($sort_by, $order_by)->paginate($limit_by);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();

            $request->merge([
                'email_verified_at' => $request->email_verified_at == 1 ? now() : null,
            ]);
            $user = User::create($request->except(['_token', 'image', 'password_confirmation']));
            ImageManger::uploadImages($request, null, $user);
          
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['erorrs', $e->getMessage()]);
        }
        Session::flash('success', 'user created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show',compact(['user'])) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       
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
        Session::flash('success', 'user deleted successfully');
        return redirect()->route('admin.users.index');
    }

    public function changeStatus($id)
    {

        $user = User::findOrFail($id);

        if ($user->status == 1) {
            $user->update([
                'status' => 0
            ]);
            Session::flash('success', 'User Blocked Successfully');
        } else {
            $user->update([
                'status' => 1
            ]);
            Session::flash('success', 'User Active Successfully');
        }
        return redirect()->back();
    }
}
