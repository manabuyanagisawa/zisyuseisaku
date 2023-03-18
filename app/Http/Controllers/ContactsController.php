<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactsSendmail;
use App\Models\Shop;

class ContactsController extends Controller
{
    public function index(){
        $shops = Shop::all();
        $shop_names = $shops->pluck('name', 'id')->toArray() ?? [];
        return view('contact.index',compact('shop_names'));
    }

    public function confirm(Request $request)
{
    $request->validate([
    'shop' => 'required',
    'email' => 'required|email',
    'title' => 'required',
    'body' => 'required',
    ],
    [
        'shop.required' => '店舗名は必ず選択してください。',
        'email.required' => 'アドレスは必ず入力してください。',
        'title.required' => 'タイトルは必ず入力してください。',
        'body.required' => '内容は必ず入力してください。'
    ]);

    $inputs = $request->all();
    $shop = Shop::find($inputs['shop']);

    return view('contact.confirm',compact('inputs','shop'));
}

public function send(Request $request)
{
    // actionの値を取得
    $action = $request->input('action');

    // action以外のinputの値を取得
    $inputs = $request->except('action');

    //actionの値で分岐
    if($action !== 'submit'){

        // 戻るボタンの場合リダイレクト処理
        return redirect()
        ->route('contact.index')
        ->withInput($inputs);
        
    } else {
        // 送信ボタンの場合、送信処理

        // ユーザにメールを送信
        \Mail::to($inputs['email'])->send(new ContactsSendmail($inputs));
        // 自分にメールを送信
        \Mail::to('y.manabu1990@gmail.com')->send(new ContactsSendmail($inputs));

        // 二重送信対策のためトークンを再発行
        $request->session()->regenerateToken();

        // 送信完了ページのviewを表示
        return view('contact.thanks');
    }
}
}
