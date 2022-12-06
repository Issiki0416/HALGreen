<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner; //Eloquentモデルを使うために追加
use Illuminate\Support\Facades\DB; //DBクラスを使うために追加
use Carbon\Carbon; //日付を扱うために追加
use Illuminate\Support\Facades\Hash;

class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // adminでログインしているかどうかを確認する
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {

        // $date_now = Carbon::now();
        // $date_parse = Carbon::parse(now());
        // echo $date_now->year; //英語で確かに分かりやすい
        // echo $date_now;
        // echo $date_parse;


        // $e_all = Owner::all();
        // $q_get = DB::table('owners')->select('name', 'created_at')->get();
        // $q_first = DB::table('owners')->select('name')->first();

        // $c_test = collect(['name' => 'test']);

        // var_dump($q_first);
        // dd('admin owners indexです');
        // dd($e_all, $q_get, $q_first, $c_test);
        $owners = Owner::select('id' , 'name', 'email', 'created_at')->paginate(3);
        return view('admin.owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.owners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // フォーム人入力された値がリクエストクラスになってそのまま$requestに入ってくる
        // $request->nameでオーナー名が入ってくる
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:owners'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        Owner::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 登録後リダイレクト
        return redirect()
        ->route('admin.owners.index')
        ->with([
            'message' => 'オーナーを登録しました。',
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
        $owner = Owner::findOrFail($id);
        // dd($owner);
        return view('admin.owners.edit', compact('owner'));
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
        // このRequestクラスをインスタンス化した$requestに入力された値が入ってくる
        $owner = Owner::findOrFail($id);
        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->password = Hash::make($request->password);
        $owner->save();

        return redirect()
        ->route('admin.owners.index')
        ->with([
            'message' => 'オーナー情報を更新しました。',
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
        Owner::findOrFail($id)->delete(); //ソフトデリート


        return redirect()->route('admin.owners.index')
        ->with([
            'message' => 'オーナー情報を削除しました。',
            'status' => 'alert'
        ]);
    }

    public function expiredOwnerIndex(){
        $expiredOwners = Owner::onlyTrashed()->paginate(3);////ソフトデリートされたオーナーを取得
        return view('admin.expired-owners',compact('expiredOwners'));
    }

    public function expiredOwnerDestroy($id){
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.expired-owners.index')->with([
            'message' => 'オーナー情報を完全に削除しました。',
            'status' => 'alert'
        ]);;
    }
}
