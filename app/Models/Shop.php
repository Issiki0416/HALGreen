<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;

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
}
