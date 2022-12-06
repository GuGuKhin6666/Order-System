<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class RouteController extends Controller
{
    public function getdata(){
        $data =[
            'product' =>Product::get(),
            'user' => User::get(),
            'order' => Order::get(),
        ];
        return response()->json($data,200);
    }

    public function apigetdata (){
        $data = Product::get();
        return response()->json($data,200);
    }

    public function datainto(Request $request){
        dd($request->all());
    }

    public function deletedata($id){
     
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status'=>'true','message'=>'delete successful'],200);
        }
        return response()->json(['status'=>'false','message'=>'delete fail'],200);
    }

    public function updatedata(Request $request){
        $category_id = $request->category_id;
        $data = Category::where('id',$category_id)->first();

        
        if(isset($data)){
            $db = $this->getdatarequest($request);
            Category::where('id',$category_id)->update($db);
            $response = Category::where('id',$category_id)->first();
            return response()->json(['status'=>'true','message'=>'delete successful','response' => $response],200);
        }

        return response()->json(['status'=>'false','message'=>'delete fail'],200);
    }

    private function getdatarequest($request){
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ];
    }

}
