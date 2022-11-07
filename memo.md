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
```html
   <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
```

当たり前だがAuthは認証に関するファイル(app/Http/Controllers/Auth)
<img width="1107" alt="image" src="https://user-images.githubusercontent.com/96870513/200371028-ab7bceda-d9ba-43e8-a63a-5b7c42384071.png">
