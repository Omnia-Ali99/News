<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function index(){

    return view('frontend.contact-us');

  }

  public function store(ContactRequest $request){
      
    $request->validated();

    $request->merge([
        'ip_address'=>$request->ip(),
    ]);
    
     $contact =Contact::create($request->except('_token'));

     if(!$contact){
        Session::flash('Contact us failed');
         return redirect()->back();
    }
        
        Session::flash('success','your message created successfully');
        return redirect()->back();
   
  }
}
