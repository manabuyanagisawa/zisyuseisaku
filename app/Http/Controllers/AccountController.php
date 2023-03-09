<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    // ①ユーザー一覧画面表示
    public function index(Request $request){
        $keyword = $request->input('keyword');

        // 商品名検索
        $query = User::query();
        if(!empty($keyword)) {
        $query->where('name', 'LIKE', "%{$keyword}%");
        }

        $search_users = $query->paginate(10)->withQueryString();
        $users = User::all();

        
        return view('account.index',compact('keyword','search_users','users'));
    }

    // ②ユーザーの更新画面へ遷移
    public function detail($id){
        $registered_user = User::find($id);
        return view('account.detail',compact('registered_user'));
    }
}
