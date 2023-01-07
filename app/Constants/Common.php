<?php
namespace App\Constants;

class Common
{
    const PRODUCT_ADD = '1';
    const PRODUCT_REDUCE = '2';

    // 連想配列で定数を定義
    // self::PRODUCT_ADD とかで取得するので連想配列にしておくと便利
    const PRODUCT_LIST = [
        'add' => self::PRODUCT_ADD,
        'reduce' => self::PRODUCT_REDUCE,
    ];

}
