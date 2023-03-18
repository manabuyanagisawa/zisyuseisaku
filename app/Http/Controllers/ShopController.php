<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;

class ShopController extends Controller
{
    // ①店舗登録画面表示
    public function add(){
        return view('shop.add');
    }

    // ②店舗の登録機能 登録後、ホーム画面へ遷移
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:100',
        ],
        [
            'name.required' => '店舗名は必ず入力してください。',
            'name.max' => '文字数制限を超えています。'
        ]);
        Shop::create([
            'name' => $request->name,
        ]);
        return redirect('/shops/thanks');

    }

    // ③登録完了画面の表示
    public function showThanks(){
        return view('shop.thanks');
    }
    
}
