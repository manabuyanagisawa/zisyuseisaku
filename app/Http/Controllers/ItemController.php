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
        $search_items = $query->paginate(10);
        $items = Item::all();
        return view('item.index', compact('items','search_items','keyword','type','brand','status'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'price' => 'required|max:10',
                'type' => 'required',
                'brand' => 'required',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'price' => $request->price,
                'type' => $request->type,
                'brand' => $request->brand,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }
}
