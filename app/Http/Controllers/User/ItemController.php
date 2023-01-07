<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;


class ItemController extends Controller
{
    // コントローラの方でログインしているかどうかチェックする
    public function __construct()
    {
        // middlewareのauth:ownersは、config/auth.phpに定義されている→オーナーかどうか確認する
        $this->middleware('auth:users');
    }

    public function index()
    {
        $products = Product::availableItems()->get();

        // dd($stocks, $products);
        // $products = Product::all();

        return view('user.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity'); // 商品の在庫数を取得
        if($quantity > 9){
            $quantity = 9;
        }
        return view('user.show', compact('product', 'quantity'));
    }
}
