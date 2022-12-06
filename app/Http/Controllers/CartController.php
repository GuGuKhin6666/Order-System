<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //card page
    public function cart(){
    $data = Cart::select('*','carts.id as cart_id')
            ->leftjoin('products','products.id','carts.product_id')
            ->get();
          $totalprice =0;
          foreach($data as $d){
            $totalprice += $d->price * $d->qty;
          }
        return view('user.cart.cart',compact('data','totalprice'));
    }


    //see order
    public function seeorder(){
      $order = Order::orderBy('id','desc')
      ->where('user_id',Auth::user()->id)
      ->paginate('6');
      return view('user.cart.order',compact('order'));
    }
}

