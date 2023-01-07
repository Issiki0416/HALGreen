<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\User;

class CartController extends Controller
{
    public function index()
    {
        $total_price = 0;
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        foreach($products as $product){
            $total_price += $product->price * $product->pivot->quantity;
        }

        // dd($products, $total_price);
        return view('user.cart', compact('products', 'total_price'));
    }

    public function add(Request $request){

        $itemInCart = Cart::where('product_id', $request->product_id)->where('user_id', Auth::id())->first();//and条件

        // cartがにはいっている商品が1でリクエストが2の場合なら3となる
        if($itemInCart){
            $itemInCart->quantity += $request->quantity;
            $itemInCart->save();
        }else{
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }
        return redirect()->route('user.cart.index');
    }
}
