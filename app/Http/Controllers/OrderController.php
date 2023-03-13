<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // ①客注画面の表示A
    public function add($id){
        // 選択されたアイテムの情報を取得
        $move_item = Item::find($id);
        $shops = Shop::all();
        $shop_names = $shops->pluck('name', 'id')->toArray();
        return view('order.add',compact('move_item','shop_names'));
    }

    // ②客注機能A(商品発送の店舗)
    public function lost(Request $request,$id){
        $move_item = Item::find($id);
        $move_stock = $request->input('move_stock');
        
        // -1などのマイナスの数値を入力された場合のエラー
        if ($move_stock < 0) {
            $errorMessage = '0以上の数にて、もう一度お試しください。';
            return redirect()->back()->withErrors([$errorMessage]);
        }

        $new_stock = $move_item->stock - $move_stock;

        // 在庫がマイナスになってしまう場合のエラー
        if ($new_stock < 0) {
            $errorMessage = '在庫がマイナスになります。数を減らしてください。';
            return redirect()->back()->withErrors([$errorMessage]);
        }
        
        $request->validate([
            'stock' => 'integer',
        ]);
        Item::find($id)->update([
            'stock' => $new_stock
        ]);
        return redirect()->route('order.getShow',compact('move_stock'));
    }

    // ③客注画面の表示B
    public function getShow(){
        // 選択されたアイテムの情報を取得
        $shops = Shop::all();
        $shop_names = $shops->pluck('name', 'id')->toArray();
        return view('order.get',compact('shop_names'));
    }

    // ③客注機能B(商品受け取りの店舗)
    public function get(Request $request,$id){
        $shops = Shop::all();
        $shop_names = $shops->pluck('name', 'id')->toArray();

        $get_item = Item::find($id);
        $get_shop_id = $get_item->shop_id;
        $get_shop_name = Shop::find($get_shop_id)->name;
    
        $item_name = $get_item->name;
        $item_price = $get_item->price;
        $item_type = $get_item->type;
        $item_brand = $get_item->brand;
        $item_shop_id = $get_item->shop_id;
        $item_wear_size = $get_item->wear_size;
        $item_color = $get_item->color;
        $item_season = $get_item->season;
    
        if(isset($get_shop_name)){
            $request->validate([
                'stock' => 'integer',
            ]);
            Item::find($id)->update([
                'stock' => $request->stock,
            ]);
        }else{
            $request->validate([
                'stock' => 'integer',
            ]);
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $item_name,
                'price' => $item_price,
                'type' => $item_type,
                'brand' => $item_brand,
                'shop_id' => $item_shop_id,
                'wear_size' => $item_wear_size,
                'color' => $item_color,
                'stock' => $request->stock,
                'season' => $item_season
            ]);
        }
        return redirect()->route('home');
    }
}
