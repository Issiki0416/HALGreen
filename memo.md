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

