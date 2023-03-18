<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Shop;
use App\Models\User;
use App\Models\Stock;
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
        $user_role = $user_id->role;
        $shops = Shop::all();
        // 店舗の ID をキーにした配列を作成する
        $shop_names = $shops->pluck('name', 'id')->toArray();

        // 商品一覧取得
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $brand = $request->input('brand');
        $season= $request->input('season');
        
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
        //シーズン検索
        if(!is_null($season)) {
        $query->where('season', $season);
        }
            

        // ページネーション設定 (10)は一度に表示する数
        // withQueryStringを使って検索後のページネーション
        $search_items = $query->paginate(10)->withQueryString();
        $items = Item::all();
        return view('item.index', compact(
            'items',
            'search_items',
            'keyword',
            'type',
            'brand',
            'season',
            'user_role',
            'shop_names',
        ));
    }


    // ①商品登録画面表示
    public function add(){
        $shops = Shop::all();
        return view('item.add',compact('shops'));
    }

    // ②入力後→登録内容確認画面へ遷移
    public function confirm(Request $request){
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|integer',
            'type' => 'required',
            'brand' => 'required',
            'wear_size' => 'integer',
            'color' => 'required|integer',
            'season' => 'required|max:4'
        ],
        [
            'name.required' => '名前は必ず入力してください。',
            'name.max' => '文字数制限を超えています。',            
            'price.required' => '値段は必ず入力してください。',
            'price.integer' => '値段は必ず整数で入力してください。',
            'type.required' => '種別は必ず選択してください。',
            'brand.required' => 'ブランドは必ず選択してください。',
            'season.required' => 'シーズンは必ず選択してください。',
            'season.max' => '文字数制限を超えています。4文字以内で例のように入力してください。(例:23SS)',
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
                'wear_size' => $request->wear_size,
                'color' => $request->color,
                'season' => $request->season
            ]);
            return redirect('/items/thanks');
    }}

      // ④登録完了画面の表示
    public function showThanks(){
        return view('item.thanks');
    }

    // ⑤商品の詳細画面へ遷移
    public function detail($id){
        $registered_item = Item::find($id);
        $shop = Shop::all();
        $user_id = $registered_item->user_id;
        $registered_user = User::find($user_id);
        $update_user_id = $registered_item->update_user_id;
        $update_user = User::find($update_user_id);
        $inventories = Stock::where('item_id', $registered_item->id)->get();
        return view('item.detail',compact('registered_item','shop','registered_user','update_user','inventories'));
    }

    // ⑥更新機能 更新後にホーム画面に遷移
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|integer',
            'type' => 'required',
            'brand' => 'required',
            'wear_size' => 'integer',
            'color' => 'required|integer',
            'season' => 'required|max:4'
        ],
        [
            'name.required' => '名前は必ず入力してください。',
            'name.max' => '文字数制限を超えています。',            
            'price.required' => '値段は必ず入力してください。',
            'price.integer' => '値段は必ず整数で入力してください。',
            'type.required' => '種別は必ず選択してください。',
            'brand.required' => 'ブランドは必ず選択してください。',
            'season.required' => 'シーズンは必ず選択してください。',
            'season.max' => '文字数制限を超えています。4文字以内で例のように入力してください。(例:23SS)',
        ]);
        Item::find($id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'type' => $request->type,
            'brand' => $request->brand,
            'wear_size' => $request->wear_size,
            'color' => $request->color,
            'season' => $request->season,
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
