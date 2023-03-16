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
        return redirect()->route('order.getShow',compact('move_stock', 'id'))->with('stock', $move_stock)->with('item', $move_item);
    }

// ③客注画面の表示B
    public function getShow(){
        // 選択されたアイテムの情報を取得
        $shops = Shop::all();
        $shop_names = $shops->pluck('name', 'id')->toArray() ?? [];

        $move_item = session()->get('item');
        $move_stock = session()->get('stock');

        return view('order.get',compact('shop_names','move_item','move_stock'));
    }

// ③客注機能B(商品受け取りの店舗)
    public function get(Request $request){
        $shop_id = $request->input('shop_id');
        $item = Item::where('shop_id', $shop_id)->first();
        $moveStock = $request->input('moveStock');
        if(isset($item->stock)){
            $new_stock = $item->stock + $moveStock;
            $item->update([
                'stock' => $new_stock,
            ]);
        }else{
            $new_stock = $moveStock;
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'price' => $request->price,
                'type' => $request->type,
                'brand' => $request->brand,
                'shop_id' => $request->shop_id,
                'wear_size' => $request->wear_size,
                'color' => $request->color,
                'stock' => $new_stock,
                'season' => $request->season
            ]);
        }
        return redirect()->route('home');
    }
}
