<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Cart as Cart;
use Validator;
use App\Order;
use App\Product;
use Auth;
use DB;
use Storage;

class CartController extends Controller
{
public function __construct()
{
//  $this->middleware('auth');
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart');
    }
    
    public function shownum()
    {
        return Cart::count();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if (!$duplicates->isEmpty()) {
            return redirect('cart')->withSuccessMessage('Item is already in your cart!');
        }
        $product = Product::where('id', $request->id)->firstOrFail();
        
        Cart::add($request->id, $product->imgname, 1, $product->price,['level' => 'L0'])->associate('App\Product');
        //return redirect('cart')->withSuccessMessage('Item was added to your cart!');
        //return Cart::count();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Validation on max quantity
//        $validator = Validator::make($request->all(), [
//            'quantity' => 'required|numeric|between:1,5'
//        ]);
//
//         if ($validator->fails()) {
//            session()->flash('error_message', 'Quantity must be between 1 and 5.');
//            return response()->json(['success' => false]);
//         }
        Cart::update($id,[ 'options' => ['level' => $request->level]]);
        session()->flash('success_message', 'Level was updated successfully!');

        return response()->json(['success' => true]);

    }

        public function checkout ()
    {
        foreach (Cart::content() as $item) {
        $rowId = $item->rowId; 
        $order = new Order;
        $order->user_id = Auth::user()->id;
        //echo Cart::get($rowId)->name;
        $product = Product::where('id', Cart::get($rowId)->id)->firstOrFail();
        $order->geometry = $product->geometry;
        $order->level = Cart::get($rowId)->options->get('level');
        if ($order->level == $product->level){
            $order->state = 3;
        }
        else {
            $order->state = 2;
        }
        $order->id_snapshot = $product->id;
        $order->price = Cart::get($rowId)->price;
        $order->save();
        
        if ($order->state == 2){        
        $ordername = "KOD/out/$order->id.txt";
        $contents = "ID: $order->id\n
ARCHIVE: YES\n
USER ID: $order->user_id\n
SNAPSHOT ID: $order->id_snapshot\n
LEVEL: $order->level\n
CREATED AT: $order->created_at\n";
        Storage::put($ordername, $contents);
        }
        }
    Cart::destroy();
    return redirect('/')->withSuccessMessage('Order is placed!');    
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect('cart')->withSuccessMessage('Item has been removed!');
    }

    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyCart()
    {
        Cart::destroy();
        return redirect('cart')->withSuccessMessage('Your cart has been cleared!');
    }

}

