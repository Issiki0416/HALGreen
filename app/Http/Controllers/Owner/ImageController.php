<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;


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
        return view('owner.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        // 複数の画像を取得する
        $imageFiles =  $request->file('files');
        if(!is_null($imageFiles)){
            foreach($imageFiles as $imageFile){
                $fileNameToStore = ImageService::upload($imageFile, 'products');
                Image::create([
                    'owner_id' => Auth::id(),
                    'filename' => $fileNameToStore,
                ]);
            }
        }
        return redirect()
        ->route('owner.images.index')
        ->with([
            'message' => '画像を登録しました',
            'status' => 'info'
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        // dd(Shop::findOrFail($id));
        return view('owner.images.edit', compact('image'));
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
        $request->validate([
            'title' => ['string', 'max:50'],
        ]);

        $image = Image::findOrFail($id);
        $image->title = $request->title;
        $image->save();

        return redirect()
        ->route('owner.images.index')
        ->with([
            'message' => '画像情報を更新しました。',
            'status' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $filePath = 'public/products/' . $image->filename;

        if(Storage::exists($filePath)){
            Storage::delete($filePath);
        }

        Image::findOrFail($id)->delete();

        return redirect()->route('owner.images.index')
        ->with([
            'message' => '画像を削除しました。',
            'status' => 'alert'
        ]);
    }
}
