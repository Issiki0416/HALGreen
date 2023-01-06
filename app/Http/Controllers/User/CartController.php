<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;

class CartController extends Controller
{
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
        dd('test');
    }
}
