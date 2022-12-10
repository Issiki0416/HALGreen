<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
        // コントローラの中でmiddlewareを使うことでコントローラのアクションにミドルウェアを適用できる
        public function __construct()
        {
            // middlewareのauth:ownersは、config/auth.phpに定義されている
            $this->middleware('auth:owners');

            $this->middleware(function ($request, $next){

                $id = $request->route()->parameter('image'); //shopのid取得
                if(!is_null($id)){ // null判定 index用
                    $imagesOwnerId = Image::findOrFail($id)->owner->id;
                    $imageId = (int)$imagesOwnerId; // キャスト 文字列→数値に型変換
                    if($imageId !== Auth::id()){ // 同じでなかったら
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
        // ログインしているオーナーのidを取得
        $ownerId = Auth::id();
        // owner_idで検索してヒットしたらgetで取得
        $images = Image::where('owner_id', $ownerId)
        ->orderBy('updated_at', 'desc')
        ->paginate(20);
        return view('owner.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
