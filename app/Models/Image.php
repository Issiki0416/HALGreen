<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;


    // モデルがその属性以外を持たないように設定する
    protected $fillable = [
        'owner_id',
        'filename',
    ];
}
