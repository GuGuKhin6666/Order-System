<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderlist;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // order list page
    public function orderlistpage(){
        $data = Order::select('*','users.name as user_name','orders.id as order_id')
        ->leftjoin('users','users.id','orders.user_id')
        ->get();
        return view('admin.order.orderlsit',compact('data'));
    }

    //get data from ajax
    public function getdata(Request $request){
        $data = Order::select('*','users.name as user_name','orders.id as order_id')
        ->leftjoin('users','users.id','orders.user_id');
        if($request->codeList == ''){
            $data = $data->get();
        }else{
            $data = $data->orwhere('orders.status',$request->codeList)->get();
        }
        return view('admin.order.orderlsit',compact('data'));
    }

    public function changestatus(Request $request){
        Order::where('id',$request->orderid)->update([
          'status' => $request->status,
        ]);
      }

    //data sent from 
    public function datasent($orderCode){
        $code = Order::where('order_code',$orderCode)->first();
        $data = Orderlist::select('*','users.name as user_name','orderlists.id as orderlists_id')
        ->leftjoin('users','users.id','orderlists.user_id')
        ->leftjoin('products','products.id','orderlists.product_id')
        ->where('order_code',$orderCode)
        ->get();
       return view('admin.order.ordercode',compact('data','code'));
    }
}
