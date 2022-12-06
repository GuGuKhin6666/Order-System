<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;

use App\Models\Order;
use App\Models\Product;
use App\Models\Orderlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //data ajax
    public function data(Request $request){
       if($request->status == 'asc'){
        $data = Product::orderBy('id','asc')->get();
       }else if($request->status == 'desc'){
        $data = Product::orderBy('id','desc')->get();
       }
       return $data;
    }

    //cart product 
    public function cart(Request $request){
        $data =$this->getdata($request);
        Cart::create($data);
        $response  =[
         'status' => 'success',
         'message' => 'Your data is store'
        ];
        return response()->json($response,200);

    }

    //delete product
    public function deleteorder(){
      $data = Product::orderBy('created_at','desc')
      ->get();
      $cart = Cart::where('user_id',Auth::user()->id)->get();
      $orderdata = Order::where('user_id',Auth::user()->id)->get();
      Cart::where('user_id',Auth::user()->id)->delete();
      return view('user.home',compact('data','cart','orderdata'));
    }

    //each data delete
    public function eachdata(Request $request){
      Cart::where('user_id',Auth::user()->id)->where('id',$request->product_id)->delete();
    }

    //change status 

    //view count
    public function viewcount(Request $request){
      $data = Product::where('id',$request->productid)->first();

      $resource =[
        'view_count' => $data->view_count +1 ,
      ];

      Product::where('id',$request->productid)->update($resource);
    }

    public function orderlist(Request $request){
      $total =0;
      foreach($request->all() as $item){
          $data =  Orderlist::create([
          'user_id'=>$item['userid'],
          'product_id'=>$item['productid'],
          'qty'=>$item['qty'],
          'total'=>$item['total'],
          'order_code'=>$item['order_code'],
          ]);

          $total += $data->total;
      }

      Cart::where('user_id',Auth::user()->id)->delete();

    
      Order::create([
        'user_id' => Auth::user()->id,
        'order_code'=> $data->order_code,
        'total_price' =>$total+4000,
      ]);
     
      
      return response()->json([
        'status' => 'success',
      ],200);
    }

    //data into db
    private function getdata($request){
      return[
         'user_id'=>$request->userid,
         'product_id'=>$request->productid,
         'qty'=>$request->quantity,
         'created_at'=>Carbon::now(),
         'update_at'=>Carbon::now(),
      ];
    }
}
