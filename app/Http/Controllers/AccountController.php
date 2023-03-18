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

    // ③ユーザーの更新機能 更新後、ホーム画面へ遷移
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required',
            'role' => 'required',
        ],
        [
            'name.required' => '名前は必ず入力してください。',
            'name.max' => '文字数制限を超えています。',
            'email.required' => 'アドレスは必ず入力してください。',
            'role.required' => '権限は必ず入力してください。',
        ]);
        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            ]);
            return redirect()->route('home');
    }

    /// ④ユーザーの削除機能 削除後、ホーム画面へ遷移する
    public function delete($id){
        $delete_user = User::find($id);
        $delete_user->delete();
        return redirect()->route('home');
    }
}
