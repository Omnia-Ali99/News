<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request()->sort_by ?? 'id';
        $order_by = request()->order_by ?? 'desc';
        $limit_by = request()->limit_by ?? 5;


        $categories = Category::withCount('posts')->when(request()->Keyword, function ($q) {
            $q->where('name', 'LIKE', '%' . request()->Keyword . '%');
        })->when(!is_null(request()->status), function ($q) {
            $q->where('status', request()->status);
        });

        $categories = $categories->orderBy($sort_by, $order_by)->paginate($limit_by);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->only(['name','status']));
        if(!$category){
            Session::flash('error', 'Try Again Latter!');
            return redirect()->route('admin.categories.index');
        }
        Session::flash('success', 'Category Ceated Successfully');
        return redirect()->route('admin.categories.index');
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
        $category = Category::findOrFail($id);
        $category->update($request->except(['_token','_method']));
        if(!$category){
            Session::flash('error', 'Try Again Latter!');
            return redirect()->route('admin.categories.index');
        }
        Session::flash('success', 'Category Updated Successfully');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash('success', 'Category Deleted Successfully');
        return redirect()->route('admin.categories.index');
    }
    
    public function changeStatus($id)
    {

        $category = Category::findOrFail($id);

        if ($category->status == 1) {
            $category->update([
                'status' => 0
            ]);
            Session::flash('success', 'Category Blocked Successfully');
        } else {
            $category->update([
                'status' => 1
            ]);
            Session::flash('success', 'Category Active Successfully');
        }
        return redirect()->back();
    }
}
