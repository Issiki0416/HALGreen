# プロジェクト作成
``` create-project laravel/laravel:^8 laravel-ec --prefer-dist ```
## DB接続
DB作ったら、.envファイルをいじる

## 言語を変更
- config/app.php
## debugbarインストール
```  composer require barryvdh/laravel-debugbar ```

## breezeをいれる
``` composer require laravel/breeze “1.*” --dev ```
``` php artisan breeze:install ```
``` npm install && npm run dev ```

以下をviewsのlayoutsに記述する
viteのところをコメントにする
resources/views/layouts/app.blade.php
resources/views/layouts/guest.blade.php
```html
   <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
```

当たり前だがAuthは認証に関するファイル(app/Http/Controllers/Auth)
<img width="1107" alt="image" src="https://user-images.githubusercontent.com/96870513/200371028-ab7bceda-d9ba-43e8-a63a-5b7c42384071.png">

## 認証機能について。Laravelインストール時にある　と　ルーティング
<img width="1107" alt="image" src="https://user-images.githubusercontent.com/96870513/200375126-0374ded7-dcc9-4a8b-b3a5-27aba656bfcd.png">

## ルートファイルの書き方
- auth.phpを確認
<img width="1107" alt="image" src="https://user-images.githubusercontent.com/96870513/200375835-b4211ed4-7fef-497f-8006-4f1e73921491.png">

## コントローラーのファイル群
<img width="1107" alt="image" src="https://user-images.githubusercontent.com/96870513/200376601-b690bb14-baa3-499b-9d90-1b766e2372b5.png">

## 日本語の設定
https://readouble.com/laravel/8.x/ja/validation-php.html
