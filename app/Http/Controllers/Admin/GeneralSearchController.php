<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class GeneralSearchController extends Controller
{
    public function search(Request $request){
       if($request->option == 'user'){
        $users = User::where('name','LIKE','%'. $request->keyword . '%')->paginate(6);
        return view('admin.users.index',compact('users'));
       } elseif($request->option == 'post'){
        $posts = Post::where('title','LIKE','%'. $request->keyword . '%')->paginate(6);
        return view('admin.posts.index',compact('posts'));
       }elseif($request->option == 'category'){
        $categories = Category::where('name','LIKE','%'. $request->keyword . '%')->paginate(6);
        return view('admin.categories.index',compact('categories'));
       }elseif($request->option == 'contact'){
        $contacts = Contact::where('name','LIKE','%'. $request->keyword . '%')->paginate(6);
        return view('admin.contacts.index',compact('contacts'));
       }else{
        return redirect()->back();
       }

    }
    
}
