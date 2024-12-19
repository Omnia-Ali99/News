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
        return $this->searchUsers($request);
             
       } elseif($request->option == 'post'){
        return $this->searchPosts($request);

       }elseif($request->option == 'category'){
        return $this->searchCategories($request);

       }elseif($request->option == 'contact'){
        return $this->searchContacts($request);

       }else{
        return redirect()->back();
       }

    }

    private function searchUsers($request){
        $users = User::where('name','LIKE','%'. $request->keyword . '%')->paginate(6);
        return view('admin.users.index',compact('users'));
    }
    private function searchPosts($request){
        $posts = Post::where('title','LIKE','%'. $request->keyword . '%')->paginate(6);
        return view('admin.posts.index',compact('posts'));
    }
    private function searchCategories($request){
        $categories = Category::where('name','LIKE','%'. $request->keyword . '%')->paginate(6);
        return view('admin.categories.index',compact('categories'));
    }
    private function searchContacts($request){
        $contacts = Contact::where('name','LIKE','%'. $request->keyword . '%')->paginate(6);
        return view('admin.contacts.index',compact('contacts'));
    }
    
}
