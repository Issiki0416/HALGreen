<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Cart;

class CartService
{
    // cart野中の複数の商品がはいる
    public static function getItemsInCart($items)
    {
        $products = [];

        foreach($items as $item){
            // オーナー情報を取得
            $p = Product::findOrFail($item->product_id);// 一つの商品を取得
            $owner = $p->shop->owner->select('name', 'email')->first()->toArray();//オーナー情報
            $values = array_values($owner); //連想配列の値を取得
            $keys = ['ownerName', 'email']; // key名を変更
            $ownerInfo = array_combine($keys, $values); // オーナー情報のキーを変更
            // dd($ownerInfo);
            // 商品情報を取得
            $product = Product::where('id', $item->product_id)
            ->select('id', 'name', 'price')->get()->toArray(); // 商品情報の配列
            $quantity = Cart::where('product_id', $item->product_id)
            ->select('quantity')->get()->toArray(); // 在庫数の配列
            // dd($product, $quantity);
            $result = array_merge($product[0], $ownerInfo, $quantity[0]); // 配列の結合 array_push($products, $result); //配列に追加
            array_push($products, $result); //配列に追加
        }
        // dd($products);


        return $products;
    }
}
