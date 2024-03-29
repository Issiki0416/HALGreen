<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\SecondaryCategory;
use App\Models\Image;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    use HasFactory;

    // モデルがその属性以外を持たないように設定する
    protected $fillable = [
        'shop_id',
        'name',
        'information',
        'price',
        'is_selling',
        'sort_order',
        'secondary_category_id',
        'image1',
        'image2',
        'image3',
        'image4',
    ];


    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function category()
    {
        return $this->belongsTo(SecondaryCategory::class,'secondary_category_id');
    }

    public function imageFirst()
    {
        return $this->belongsTo(Image::class,'image1', 'id');
    }
    public function imageSecond()
    {
        return $this->belongsTo(Image::class,'image2', 'id');
    }
    public function imageThird()
    {
        return $this->belongsTo(Image::class,'image3', 'id');
    }
    public function imageFourth()
    {
        return $this->belongsTo(Image::class,'image4', 'id');
    }

    // Productテーブルとのリレーションを定義
    // 1つのShopが複数のProductを持つ
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'carts')->withPivot(['id', 'quantity']);
    }

    // ローカルスコープ
    public function scopeAvailableItems($query)
    {
        $stocks = DB::table('t_stocks')
        ->select('product_id', DB::raw('sum(quantity) as quantity'))
        ->groupBy('product_id')
        ->having('quantity', '>', 1);

        return $query->joinSub($stocks, 'stocks', function ($join) {
            $join->on('products.id', '=', 'stocks.product_id');
        })
        ->join('shops', 'products.shop_id', '=', 'shops.id')
        ->join('secondary_categories', 'products.secondary_category_id', '=', 'secondary_categories.id')
        ->join('images as image1', 'products.image1', '=', 'image1.id')
        ->where('shops.is_selling', true)
        ->where('products.is_selling',true)
        ->select('products.id as id', 'products.name as name', 'products.price' ,
        'products.sort_order as sort_order','products.information', 'secondary_categories.name as category' ,
        'image1.filename as filename');
    }

    public function scopeSortOrder($query, $sortOrder)
    {
        if($sortOrder === null || $sortOrder === \Constant::SORT_ORDER_LIST['recommend']){
            return $query->orderBy('sort_order', 'asc');
        }
        if($sortOrder === \Constant::SORT_ORDER_LIST['higherPrice']){
            return $query->orderBy('price', 'desc');
        }
        if($sortOrder === \Constant::SORT_ORDER_LIST['lowerPrice']){
            return $query->orderBy('price', 'asc');
        }
        if($sortOrder === \Constant::SORT_ORDER_LIST['later']){
            return $query->orderBy('products.created_at', 'desc');
        }
        if($sortOrder === \Constant::SORT_ORDER_LIST['older']){
            return $query->orderBy('products.created_at', 'asc');
        }
    }

    public function scopeSelectCategory($query, $categoryId)
    {
        if($categoryId !== '0'){
            return $query->where('secondary_category_id', $categoryId);
        }else{
            return;
        }
    }

    public function scopeSearchKeyword($query, $keyword)
    {
        if(!is_null($keyword)) {
            $spaceConvert = mb_convert_kana($keyword,'s'); //全角スペースを半角に
            $keywords = preg_split('/[\s]+/', $spaceConvert,-1,PREG_SPLIT_NO_EMPTY); //空白で区切る
            foreach($keywords as $word) //単語をループで回す
                {
                    $query->where('products.name','like','%'.$word.'%');
                }
            return $query;
        } else {
            return;
        }
    }

}
