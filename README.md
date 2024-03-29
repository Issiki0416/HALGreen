## HAL Green

## インストール方法
1. ``` composer install ```  
2. ``` npm install ```  
3. ``` npm run dev ```  

.env.exampleをコピーして .envファイルを作成

.envファイル内に下記をご利用の環境に合わせて変更してください。  
DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=laravel_ec  
DB_USERNAME=halgreen  
DB_PASSWORD=halgreen  

DB起動後、下記コマンドを実行してください。  
``` php artisan migrate:fresh --seed ```  
と実行。（データベーステーブルとダミーデータが追加されます）

最後に  
``` php artisan key:generate ```  
と入力してキーを生成後、  
``` php artisan serve ```  
と入力して簡易サーバーを起動してください。  

## Laravelフロー
<img width="940" alt="image" src="https://user-images.githubusercontent.com/96870513/211212229-20f52c41-74b3-45be-96b2-6d89a6171a76.png">



## 概要
マルチログインに対応したECサイトです。

## バリデーション
### フォームリクエストを採用
- コントローラーで処理するのではなく、リクエストの内部で勝手に処理をしてくれる方がスマート
- フォームリクエストにはバリデーション関係の機能が組まれているのでカスタマイズがしやすい
## 機能


## マルチログイン
### それぞれモデル、マイグレーションを作成し、RouteServiceProviderをいじる
- ユーザー(商品を購入)・・・/

- 管理者(オーナーの管理)・・・/admin
    - オーナー新規登録
        - フラッシュメッセージで登録完了を表示する
    - オーナー情報の編集
        - Owner::findOrFail($id)でIDからオーナー情報を探す。404も使えるので採用。名前付きルートの第2引数にidを指定する
    - オーナー情報の削除
        - ソフトデリートで削除する
        - フラッシュメッセージで削除完了を表示する(sweetAlertで見た目を意識)
        - アラートを表示する
    - 期限切れオーナー一覧
        - オーナーの一覧を表示する
        - 期限切れのオーナーを表示する
        - 期限切れのオーナーを削除する
        - フラッシュメッセージで削除完了を表示する
        - アラートを表示する

- オーナー(商品を登録)・・・/owner
    - オーナープロフィール編集
    - 店舗情報更新(1オーナー 1店舗)
    - 画像登録
        - ファイルかどうかのバリデーション
        - ユーザ側とサーバー側でリサイズする(サーバ側:Intervention Imageを使用)
        - 画像のアップロードは商品登録時にも使うのでapp/Servicesフォルダを作成して処理を切り離すことでコントローラ側をスッキリさせる
    - 商品登録(画像、カテゴリ選択、在庫設定)
        - 画像の複数アップロード→Laravel側で配列のバリデーション
        - 配列で渡ってくる各要素にバリデーションをかける
        - 2段階のカテゴリーの追加(Primary CategoryとSecondary Category)


- 提供側
    - 商品の登録
    - 商品の編集
- 利用側
    - 商品購入
        - 決済機能：Stripe (APIのPUBRIC_KEYとSECRET_KEYを.envに記述)
    - 商品のソート
        - 価格の高い順
        - 価格の安い順
        - 新着順
    - 商品の件数表示
        - 10件
        - 20件
        - 30件
        - 40件
        - 50件
    - 商品の検索
        - キーワード
        - カテゴリー
    - メール送信
        - mailtrapでメールを送信する .envを張り替える
        - 非同期でメール送信を行う。（ジョブ、キュー、Worker、dispatch）
        - ``` php artisan queue:work ```でキューを実行する

    
    

## インストール後の設定
画像のダミーデータはpublic/imagesフォルダ内にsample1.jpgからsample6.jpgまで用意しています。     
``` php artisan storage:link ```でstorageフォルダにリンクを作成後、   
storage/app/public/productsフォルダ内に保存すると表示されます。(productsフォルダがない場合は作成してください。)   

ショップの画像も表示する場合、storage/app/public/productsフォルダを作成して画像を保存してください。  
