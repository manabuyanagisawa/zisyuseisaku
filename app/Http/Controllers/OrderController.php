<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MoveItemRequest;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // ①選択した商品の移動数入力画面の表示
    public function add($id){
        // 選択されたアイテムの情報を取得
        $move_item = Item::find($id);
        return view('order.add',compact('move_item'));
    }

    // ②商品が移動されるメソッド(移動される分、在庫数を減らす仕組み)
    public function lost(MoveItemRequest $request,$id){
        $item = Item::find($id);
        $move_stock = $request->input('move_stock');
        
        return redirect()->route('order.getShow')->with('item',$item)->with('stock',$move_stock);
    }

    // ③移動先選択画面の表示
    public function getShow(){
        // 選択されたアイテムの情報を取得
        $shops = Shop::all();

        $move_item = session()->get('item');
        $move_stock = session()->get('stock');

        return view('order.get',compact('shops','move_item','move_stock'));
    }

    // ④移動先にアイテムを渡す
    public function get(Request $request){
        $moveStock = $request->input('moveStock');
        $moveItemId = $request->input('moveItemId');

        $shop_id = $request->input('shop_id');
       
        $move_item = Item::find($moveItemId);

        // 商品の数を更新
        if($move_item !== null && $move_item->exists){
            $new_stock = $move_item->stock + $moveStock;
            $move_item->update([
                'stock' => $new_stock,
                'shop_id'=>$shop_id
            ]);
        }elseif($move_item === null){
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
        if($request->shop_id === $shop_id){
            return redirect()->route('order.cancelShow');
        }
        return redirect()->route('home');
    }

    // ⑤上のpostで客注キャンセルをした場合、キャンセル完了画面の表示
    public function cancelShow(){
        return view('order.cancel');
    }
}
