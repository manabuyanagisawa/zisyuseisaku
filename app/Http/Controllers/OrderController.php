<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // ①客注画面の表示
    public function add($id){
        // 選択されたアイテムの情報を取得
        $move_item = Item::find($id);
        return view('order.add',compact('move_item'));
    }

    // ②客注機能
    public function move(Request $request,$id){
        $move_item = Item::find($id);
        $get_shop_id = $move_item->shop_id;
        $get_shop_name = Shop::find($get_shop_id)->name;
    
        $item_name = $move_item->name;
        $item_price = $move_item->price;
        $item_type = $move_item->type;
        $item_brand = $move_item->brand;
        $item_shop_id = $move_item->shop_id;
        $item_wear_size = $move_item->wear_size;
        $item_color = $move_item->color;
        $item_season = $move_item->season;
    
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
