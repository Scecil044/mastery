<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $count = CartItem::all()->count();
        $id = Auth::user()->id;

        $product= Product::all();
        $cartItems = CartItem::all()->where('user_id', 'like', "{$id}");

        return view('cart.index', compact('cartItems','product', 'count'));
    }
    public function view(Request $request){
        $id = $request->id;
        $product =Product::findOrFail($id);
        return view('products.view', compact('product'));
    }
    public function store(Request $request){
        $id = $request->id;
        $product = Product::findOrFail($id);
        cartItem::create([
            'user_id'=> Auth::user()->id,
            'product_id'=> $product->id,
            'quantity'=> $request->quantity,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
        $notification = [
            'message'=> "Item was successfully added to Cart!",
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }
    public function destroy(Request $request){
        $id = $request->id;
        CartItem::findOrFail($id)->delete();


        return back()->with('message','Item successfully removed from cart');
    }
    public function cartCheckout(Request $request){
        dd($request->all());
    }
}
