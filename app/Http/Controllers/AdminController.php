<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RequestStack;

class AdminController extends Controller
{
     //Change password
     public function changepassword(){
        return view('admin.account.change');
    }

    //Update password
    public function passwordupdate(Request $request){
        $this->checkpasswordvalidation($request);

        $oldid = Auth::user()->id;
        $oldpassword =$request->oldpassword;
        $dbpsw = User::where('id',$oldid)->first();
        $ddhashpsw = $dbpsw->password;
        
       if(Hash::check($oldpassword,$ddhashpsw)){
        $updatedata =[
            'password'=>Hash::make($request->newpassword)
        ];
            User::where('id',$oldid)->update($updatedata);
            return back()->with(['passwordsuccess'=>'Your password is successfully change']);
           
       }else{
        return back()->with(['passworderror'=>'Your password is not in incorrect']);
       }
    }

    //detail page
    public function detailpage(){
        return view('admin.account.detail');
    }

    //Edit admin Page
    public function editadminpage(){
        return view('admin.account.edit');
    }

    //delete admin accounts
    public function deleteaccount($id){
        User::where('id',$id)->delete();
       return back();
    }

    //edit Adims Accounts
    public function editadmin(){
       $data = User::when(request('searchkey'),function($query){
        $query->orWhere('name','like','%'.request('searchkey').'%')
              ->orWhere('email','like','%'.request('searchkey').'%')
              ->orWhere('gender','like','%'.request('searchkey').'%')
              ->orWhere('phone','like','%'.request('searchkey').'%')
              ->orWhere('address','like','%'.request('searchkey').'%');
       })
       ->where('role','admin')->paginate(3);
       $data->appends(request()->all());
      return view('admin.account.adminlistaccout',compact('data'));
    }

    //admin account update
    public function role($id){
        $data = User::where('id',$id)->first();
        return view('admin.account.update',compact('data'));
    }

    //ready update account
    public function readyupdate(Request $request){
        $data = $this->changedata($request);
        User::where('id',$request->update_id)->update($data);
        return redirect()->route('editadmin#account');
    }

    //update admin profile
    public function updateprofile(Request $request,$id){
        $this->checkvalidationprofile($request);
        $data = $this->getdata($request);
        if($request->hasFile('image')){

        $dbimage = User::where('id',$id)->first();
        $dbimage = $dbimage->image;

            if($dbimage != null){
                Storage::delete('public/'.$dbimage);
            }

        $fileimage  =uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $fileimage);
        $data['image'] = $fileimage;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('detail#page');
    }

    //Password Validation
    private function checkpasswordvalidation($request){
        Validator::make($request->all(),[
            'oldpassword' =>'required | min:6 | ',
            'newpassword' =>'required | min:6 | ',
            'comfirmpassword' =>'required | min:6 | same:newpassword',
        ])->validate();
    }

    //data  update and change
    private function changedata($request){
        return [
            'role'=>$request->role,
        ];
    }
    
    //profile validation 
    private function checkvalidationprofile($request){
        Validator::make($request->all(),[
            'image'=> 'required',
        ])->validate();
    }
    
    //store update frofile data
    private function getdata($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'image'=>$request->image,
            'address'=>$request->address,
        ];
    }
}
