<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{
    // サービスプロバイダーを使う。ここではencrypterを使う
    public function showServiceProviderTest(){
        $encrypt = app()->make('encrypter');
        $password = $encrypt->encrypt('password');

        $sample = app()->make('serviceProviderTest');

        dd($sample,$password, $encrypt->decrypt($password));
    }

    public function showServiceContainerTest(){

    app()->bind('lifeCycleTest', function () {
        return 'ライフサイクルテスト';
    });
    $test = app()->make('lifeCycleTest');

    //サービスコンテナなし
    //つまりnewがいる
    // $message = new Message();
    // $sample = new Sample($message);
    // $sample->run();

    //サービスコンテナあり
    app()->bind('sample', Sample::class);
    $sample = app()->make('sample');
    $sample->run();

    // サービスコンテナの登録されていいるものを確認する
    dd(app(), $test);
    }
}
class Sample
{
    public $message;
    // 引数にクラスを入れてあげると自動でインスタンス化してくれる→DI
    public function __construct(Message $message)
    {
        $this->message = $message;
    }
    public function run(){
        $this->message->send();
    }
}

class Message
{
    public function send()
    {
        echo 'インスタンスが生成されました';
    }
}
