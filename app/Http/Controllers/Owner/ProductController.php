<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //DBクラスを使うために追加
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Image;
use App\Models\Shop;
use App\Models\PrimaryCategory;
use App\Models\Owner;
use App\Models\Stock;



class ProductController extends Controller
{

    // コントローラの中でmiddlewareを使うことでコントローラのアクションにミドルウェアを適用できる
    public function __construct()
    {
        // middlewareのauth:ownersは、config/auth.phpに定義されている→オーナーかどうか確認する
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next){

            $id = $request->route()->parameter('product'); //shopのid取得
            if(!is_null($id)){ // null判定 index用
                $productsOwnerId = Product::findOrFail($id)->shop->owner->id;
                $productId = (int)$productsOwnerId; // キャスト 文字列→数値に型変換
                if($productId !== Auth::id()){ // 同じでなかったら
                    abort(404); // abort()で404画面表示
                }
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // オーナーのidを取得してshopのproductを取得
        // オーナーと紐づいているshopのproductを取得
        // $products = Owner::findOrFail(Auth::id())->shop->product;
        // return view('owner.products.index', compact('products'));

        // n+1問題を解決するためにwithメソッドを使う→Eager Loading
        $ownerInfo = Owner::with('shop.product.imageFirst')->where('id', Auth::id())->get();
        // dd($ownerInfo);
        // foreach($ownerInfo as $owner){
        //     // dd($owner->shop->product);
        //     foreach($owner->shop->product as $product){
        //         dd($product->imageFirst->filename);
        //     }
        // }
        return view('owner.products.index', compact('ownerInfo'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = Shop::where('owner_id', Auth::id())
        ->select('id', 'name')
        ->get();

        $images = Image::where('owner_id', Auth::id())
        ->select('id', 'title' ,'filename')
        ->orderBy('updated_at', 'desc')
        ->get();

        // n+1問題を解決するためにwithメソッドを使う→Eager Loading
        // PrimaryCategoryモデルのsecondaryメソッドで動的プロパティと言われるやつで名前を設定する
        $categories = PrimaryCategory::with('secondary')->get();
        // dd($categories);

        return view('owner.products.create', compact('shops', 'images', 'categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:60'],
            'information' => ['required', 'string','max:1000'],
            'price' => ['required', 'integer'],
            'sort_order' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'shop_id' => ['required', 'exists:shops,id'],
            'category' => ['required', 'exists:secondary_categories,id'],
            'image1' => ['nullable', 'exists:images,id'],
            'image2' => ['nullable', 'exists:images,id'],
            'image3' => ['nullable', 'exists:images,id'],
            'image4' => ['nullable', 'exists:images,id'],
            'is_selling' => ['required'],
        ]);

        try{
            // $requestにフォームの情報が入っているのでそれをEloquentでDBに保存する
            DB::transaction(function () use($request){
                // $request->name;
                $product = Product::create([
                    'name' => $request->name,
                    'information' => $request->information,
                    'price' => $request->price,
                    'sort_order' => $request->sort_order,
                    'shop_id' => $request->shop_id,
                    'secondary_category_id' => $request->category,
                    'image1' => $request->image1,
                    'image2' => $request->image2,
                    'image3' => $request->image3,
                    'image4' => $request->image4,
                    'is_selling' => $request->is_selling
                ]);

                Stock::create([
                    'product_id' => $product->id,
                    'type' => 1,
                    'quantity' =>$request->quantity,
                ]);

            },2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        // 登録後リダイレクト
        return redirect()
        ->route('owner.products.index')
        ->with([
            'message' => '商品を登録しました。',
            'status' => 'info'
        ]);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
