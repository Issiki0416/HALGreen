<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;


class ShopController extends Controller
{
    // adminでログインしているかどうかを確認する
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next){
            // dd($request->route()->parameter('shop')); // 文字列
            // dd(Auth::id()); // 数値

            $id = $request->route()->parameter('shop'); //shopのid取得
            if(!is_null($id)){ // null判定 index用
                $shopsOwnerId = Shop::findOrFail($id)->owner->id;
                $shopId = (int)$shopsOwnerId; // キャスト 文字列→数値に型変換
                $ownerId = Auth::id();
                if($shopId !== $ownerId){ // 同じでなかったら
                    abort(404); // abort()で404画面表示
                }
            }
            return $next($request);
        });
    }


    public function index()
    {
        // ログインしているオーナーのidを取得
        $ownerId = Auth::id();
        // owner_idで検索してヒットしたらgetで取得
        $shops = Shop::where('owner_id', $ownerId)->get();
        return view('owner.shops.index', compact('shops'));
    }


    public function edit($id)
    {
        dd(Shop::findOrFail($id));

    }


    public function update(Request $request, $id)
    {


    }
}
