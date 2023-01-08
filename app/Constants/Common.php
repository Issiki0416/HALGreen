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


    // 商品並び順
    const ORDER_RECOMMEND = '0';
    const ORDER_HIGHER = '1';
    const ORDER_LOWER = '2';
    const ORDER_LATER = '3';
    const ORDER_OLDER = '4';

    const SORT_ORDER_LIST = [
        'recommend' => self::ORDER_RECOMMEND,
        'higherPrice' => self::ORDER_HIGHER,
        'lowerPrice' => self::ORDER_LOWER,
        'later' => self::ORDER_LATER,
        'older' => self::ORDER_OLDER,
    ];

}
