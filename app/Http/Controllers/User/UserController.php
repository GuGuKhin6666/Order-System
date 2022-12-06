<?php

namespace App\Http\Controllers\User;
use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //list 
    public function list(){
        $data = Product::orderBy('created_at','desc')
        ->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $orderdata = Order::where('user_id',Auth::user()->id)->get();
        return view('user.home',compact('data','cart','orderdata'));
    }
    
    //edit password
    public function editpassword(){
        return view('user.password.edit');
    }

    //update password
    public function updatepassword(Request $request,$id){
        $this->checkvalidation($request);
        $oldid = Auth::user()->id;
        $dbpsw = User::where('id',$id)->first();
        $dbpsw = $dbpsw->password;

        if(Hash::check($request->oldpassword,$dbpsw)){
            $hashdata =[
                'password'=>Hash::make($request->newpassword)
            ];
            User::where('id',$oldid)->update($hashdata);
            return back()->with(['passwordsuccess'=>'Your password is successfully change']);
        }else{
            return back();
        }
    }

    //filter product
    public function filter($id){
        $data = Product::where('category_id',$id)->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $category = Category::get();
        $orderdata = Order::where('user_id',Auth::user()->id)->get();
        return view('user.home',compact('data','category','cart','orderdata'));
    }

    //request ajax data
    public function datalistdate(Request $request){
        logger($request->all());
        $data = [
            'role' => $request->role,
        ];
        User::where('id',$request->userid)->update($data);
    }

    //data return
    public function datareturn(){
        $data =User::where('role','user')->get();
        return view('admin.account.list',compact('data'));
    }

    //edit Account
    public function editpage($id){
        $data = User::where('id',$id)->first();
        return view('user.account.edit',compact('data'));
    }

    //details product
    public function detail($id){
        $data = Product::where('id',$id)->get();
        $datas =Product::get();
        return view('user.product.detail',compact('data','datas'));
    }

    

    //update account
    public function updatepage($id,Request $request){  
        $this->validationcheck($request);
       $data =  $this->getdata($request);
       if($request->hasFile('image')){
           $img =User::where('id',$id)->first();
           $img = $img->image;
           
           if($img != null){
            storage::delete('public/'.$img);
           }

           $Newimage = uniqid().$request->file('image')->getClientOriginalName();
           $request->file('image')->storeAs('public',$Newimage);
           $data['image'] = $Newimage;
       }
       User::where('id',$id)->update($data);
       return redirect()->route('user#home');
    }


    //Update account Getdata
    private function getdata($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
        ];
    }

    // Update account Validation
     private function validationcheck($request){
        Validator::make($request->all(),[
            'image' => 'mimes:jpg,png,jpeg,webp,'.$request->userid,
        ])->validate();
     }

    //check validation
    private function checkvalidation($request){
        Validator::make($request->all(),[
            'oldpassword' => 'required | min:5 |',
            'newpassword' => 'required | min:5',
            'comfirmpassword' => 'required | min:5 | same:newpassword',
        ])->validate();
    }
}