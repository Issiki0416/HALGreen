<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    // 画像がアップロードされたら
    public static function upload($imageFile,$folderName){
        // dd($imageFile['image']);
        if(is_array($imageFile)){
            $file = $imageFile['image']; // 配列なので[‘key’] で取得
        }else{
            $file = $imageFile;
        }

        $fileName = uniqid(rand().'_');//ファイル名を作成
        $extension = $file->extension();//拡張子を取得
        $fileNameToStore = $fileName. '.' . $extension;
        $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();//画像をmakeに入れて使えるようにする

        Storage::put('public/'. $folderName . '/' . $fileNameToStore, $resizedImage );

        return $fileNameToStore;
    }
}
