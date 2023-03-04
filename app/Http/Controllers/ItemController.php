<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index(Request $request)
    {
        $user_id = Auth::user();
        $user_role = DB::select('select role from users where id = ?',[$user_id->role])[0]->role;

        // 商品一覧取得
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $brand = $request->input('brand');
        $status = $request->input('status');
        
        // 商品名検索
        $query = Item::query();
        if(!empty($keyword)) {
        $query->where('name', 'LIKE', "%{$keyword}%");
        }
        // アイテム検索
        if(!is_null($type)) {
        $query->where('type', $type);
        }
        //ブランド検索
        if(!is_null($brand)) {
        $query->where('brand', $brand);
        }
        //在庫検索
        if(!is_null($status)) {
        $query->where('status', $status);
        }
        
        // ページネーション設定 (10)は一度に表示する数
        // withQueryStringを使って検索後のページネーション
        $search_items = $query->paginate(10)->withQueryString();
        $items = Item::all();
        return view('item.index', compact('items','search_items','keyword','type','brand','status','user_role'));
    }


    // ①商品登録画面表示
    public function add(Request $request){
        return view('item.add');
    }

    // ②入力後→登録内容確認画面へ遷移
    public function confirm(Request $request){
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|integer',
            'type' => 'required',
            'brand' => 'required',
        ]);
        $inquiry = $request->all();
        return view('item.confirm',compact('inquiry'));
    }

    // ③登録画面へ戻るor登録完了画面へ遷移
    public function store(Request $request){
        $action = $request->input('action');
        $inquiry = $request->except('action');
        
        if($action !== 'submit'){
            return redirect()
            ->route('item.add')
            ->withInput($inquiry);
        }else{
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'price' => $request->price,
                'type' => $request->type,
                'brand' => $request->brand,
            ]);
            return redirect('/items/thanks');
    }}

      // ④登録完了画面の表示
    public function showThanks(){
        return view('item.thanks');
    }

    // ⑤商品の詳細画面へ遷移
    public function detail($id){
        $registered_item =Item::find($id);
        return view('item.detail',compact('registered_item'));
    }

    // ⑥更新機能 更新後にホーム画面に遷移
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|integer',
            'type' => 'required',
            'status' => 'required',
            'brand' => 'required',
        ]);
        Item::find($id)->update([
            'name' => $request->name,
            'price'  => $request->price,
            'type'  => $request->type,
            'status' => $request->status,
            'brand' => $request->brand,
            'update_user_id' => Auth::id(),
            ]);
            return redirect()->route('home');
    }
    
    // ⑦商品の削除機能 削除後、ホーム画面へ遷移する
    public function delete($id){
        $delete_item = Item::find($id);
        $delete_item->delete();
        return redirect()->route('home');
    }

}
