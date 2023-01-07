<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;
use App\Models\Product;

class Shop extends Model
{
    use HasFactory;

    // モデルがその属性以外を持たないように設定する
    protected $fillable = [
        'owner_id',
        'name',
        'information',
        'filename',
        'is_selling',
    ];

    // Ownerテーブルとのリレーションを定義
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    // Productテーブルとのリレーションを定義
    // 1つのShopが複数のProductを持つ
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
