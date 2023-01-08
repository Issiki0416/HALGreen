<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use App\Models\PrimaryCategory;



class ItemController extends Controller
{
    // コントローラの方でログインしているかどうかチェックする
    public function __construct()
    {
        // middlewareのauth:ownersは、config/auth.phpに定義されている→オーナーかどうか確認する
        $this->middleware('auth:users');


        $this->middleware(function ($request, $next){
            $id = $request->route()->parameter('item');// web.phpのshowの{item}の値を取得
            if(!is_null($id)){ // null判定 index用
                $itemId = Product::availableItems()->where('products.id', $id)->exists();
                if(!$itemId){
                    abort(404); // abort()で404画面表示
                }
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        // dd($request);

        $products = Product::availableItems()
        ->selectCategory($request->category ?? '0')
        ->sortOrder($request->sort)
        ->paginate($request->pagination ?? 10);


        $categories = PrimaryCategory::with('secondary')->get();

        // dd($stocks, $products);
        // $products = Product::all();

        return view('user.index', compact('products', 'categories'));
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
