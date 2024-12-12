<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){

        $sort_by = request()->sort_by ?? 'id';
        $order_by = request()->order_by ?? 'desc';
        $limit_by = request()->limit_by ?? 5;

        $contacts = Contact::when(request()->Keyword, function ($q) {
            $q->where('name', 'LIKE', '%' . request()->Keyword . '%')
            ->where('title', 'LIKE', '%' . request()->Keyword . '%');
        })->when(!is_null(request()->status), function ($q) {
            $q->where('status', request()->status);
        });
        
        $contacts = $contacts->orderBy($sort_by, $order_by)->paginate($limit_by);
        return view('admin.contacts.index', compact('contacts'));

    }
    public function show($id){
        $contact = Contact::findOrFail($id);
        $contact->update(['status'=>1]);
        return view("admin.contacts.show",compact('contact'));


    }
    public function destroy($id){
        $contact = Contact::findOrFail($id);
        $contact->delete();
        Session::flash('success','Contact Deleted Successfully!');
        return redirect()->route("admin.contacts.index");
    }
}
