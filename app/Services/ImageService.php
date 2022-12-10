<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    // 画像がアップロードされたら
    public static function upload($imageFile,$folderName){

        $fileName = uniqid(rand().'_');//ファイル名を作成
        $extension = $imageFile->extension();//拡張子を取得
        $fileNameToStore = $fileName. '.' . $extension;
        $resizedImage = InterventionImage::make($imageFile)->resize(1920, 1080)->encode();//画像をmakeに入れて使えるようにする

        Storage::put('public/'. $folderName . '/' . $fileNameToStore, $resizedImage );

        return $fileNameToStore;
    }
}
