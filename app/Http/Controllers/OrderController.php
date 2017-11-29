<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    public function index(){
        //$orders = Order::where('user_id',Auth::user()->id)->get();
        $user = Auth::user();
        $orders=$user->orders;
        return view('orders',['orders'=>$orders, 'user'=>$user]);
    }
 
    public function viewOrder($orderId){
        $order = Order::find($orderId);
        return view('order',['order'=>$order]);
    }
}
