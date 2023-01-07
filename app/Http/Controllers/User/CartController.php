<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\User;
use App\Models\Stock;

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

    public function add(Request $request)
    {
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

    public function delete($item_id)
    {
        $itemInCart = Cart::where('product_id', $item_id)->where('user_id', Auth::id())->first();
        $itemInCart->delete();
        return redirect()->route('user.cart.index');
    }

    public function checkout()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;//すべての商品を取得
        $lineItems = [];
        foreach($products as $product){
            $quantity = Stock::where('product_id', $product->id)->sum('quantity');// 現在の在庫数

            if($product->pivot->quantity > $quantity){
                return redirect()->route('user.cart.index')->with('flash_message', '在庫が足りません。');// indexメソッド内の変数もviewに渡すのでredirect
            }else{
                // stripeの使用に乗っ取り、一つの商品の情報
                $lineItem = [
                    'name' => $product->name,
                    'description' => $product->information,
                    'amount' => $product->price,
                    'currency' => 'jpy',
                    'quantity' => $product->pivot->quantity,
                ];
                array_push($lineItems, $lineItem);
            }
        }
        // dd($lineItems);
        foreach($products as $product){
            Stock::create([
                'product_id' => $product->id,
                'type' => \Constant::PRODUCT_LIST['reduce'],
                'quantity' => $product->pivot->quantity * -1,
            ]);
        }

        dd('test');

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));//stripeの秘密鍵
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('user.items.index'),
            'cancel_url' => route('user.cart.index'),
        ]);

        $publickey = env('STRIPE_PUBLIC_KEY');

        return view('user.checkout', compact('session', 'publickey'));

    }
}
