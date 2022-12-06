<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //Contact mail
    public function sendmail(){
        return view('user.contact.contactmail');
    }

    //list mail
    public function maillistpage(){
        $data = Contact::get();
        return view('admin.contact.list',compact('data'));
    }

    //delete mail
    public function deletemail($id){
       Contact::where('id',$id)->delete();
       return back();
    }
    
    //contact me 
    public function contactme(Request $request){
        $this->validationstatus($request);
        $data = $this->getdata($request);
        Contact::create($data);
        return back();
    }

    //insert data into database
    public function getdata($request){
        return [
            'name' => $request->username,
            'email' => $request->useremail,
            'message' => $request->usermessage,
        ];
    }

    //validation status
    private function validationstatus($request){
        Validator::make($request->all(),[
            'username' => 'required' ,
            'useremail' => 'required' ,
            'usermessage' => 'required' ,
        ])->validate();
    }

}
