<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Item;

class StockController extends Controller
{

    public function create(Request $request, $id)
    {
        $item = Item::find($id);
        $shop_id = $request->input('shop_id');

        $request->validate(
            [
                'stock' => 'integer|min:1',
            ],
            [
                'stock.integer' => '在庫は必ず整数にしてください。',
                'stock.min' => '1以上の数値を入力してください。',
            ]
        );

        if (Stock::where('shop_id', $shop_id)->where('item_id', $item->id)->exists()) {
            $now_stock = Stock::where('shop_id', $shop_id)->where('item_id', $item->id)->first()->stock;
            $new_stock = $now_stock + $request->input('stock');
            Stock::where('shop_id', $shop_id)->where('item_id', $item->id)->update([
                'stock' => $new_stock
            ]);
        } else {
            Stock::create([
                'item_id' => $item->id,
                'shop_id' => $request->shop_id,
                'stock' => $request->stock,
            ]);
        }

        return redirect()->route('home');
    }

    public function reduce(Request $request, $id)
    {
        $item = Item::find($id);
        $shop_id = $request->input('shop_id');

        if (Stock::where('shop_id', $shop_id)->where('item_id', $item->id)->exists()) {
            $now_stock = Stock::where('shop_id', $shop_id)->where('item_id', $item->id)->first()->stock;  
            $request->validate(
                [
                    'stock' => "integer|min:1|max:{$now_stock}",
                ],
                [
                    'stock.integer' => '在庫は必ず整数にしてください。',
                    'stock.min' => '1以上の数値を入力してください。',
                    'stock.max' => '在庫がマイナスになります。',
                ]
            );
            $new_stock = $now_stock - $request->input('stock');
            Stock::where('shop_id', $shop_id)->where('item_id', $item->id)->update([
                'stock' => $new_stock
            ]);
            return redirect()->route('home');
        } else {
            $errors = collect(['商品が存在しません。']);
            return back()->withErrors($errors);
        }
    }

    public function fluctuating(Request $request, $id){
        $item = Item::find($id);

        // $get_shopは移動先の店舗 $move_shopは出荷店舗 $fluctuating_stockは変動する在庫
        $get_shop = $request->input('get_shop');
        $move_shop = $request->input('move_shop');
        $fluctuating_stock = $request->input('fluctuating_stock');

        // 移動先の店舗の処理(在庫追加)
        $request->validate(
            [
                'fluctuating_stock' => 'integer|min:1',
            ],
            [
                'fluctuating_stock.integer' => '在庫は必ず整数にしてください。',
                'fluctuating_stock.min' => '1以上の数値を入力してください。',
            ]
        );

        if (Stock::where('shop_id', $get_shop)->where('item_id', $item->id)->exists()) {
            $now_stock = Stock::where('shop_id', $get_shop)->where('item_id', $item->id)->first()->stock;
            $new_stock = $now_stock + $request->input('fluctuating_stock');
            Stock::where('shop_id', $get_shop)->where('item_id', $item->id)->update([
                'stock' => $new_stock
            ]);
        } else {
            Stock::create([
                'item_id' => $item->id,
                'shop_id' => $get_shop,
                'stock' => $fluctuating_stock,
            ]);
        }

        // 出荷店舗の処理(在庫の減算)
        if (Stock::where('shop_id', $move_shop)->where('item_id', $item->id)->exists()) {
            $now_stock = Stock::where('shop_id', $move_shop)->where('item_id', $item->id)->first()->stock;  
            $request->validate(
                [
                    'fluctuating_stock' => "integer|min:1|max:{$now_stock}",
                ],
                [
                    'fluctuating_stock.integer' => '在庫は必ず整数にしてください。',
                    'fluctuating_stock.min' => '1以上の数値を入力してください。',
                    'fluctuating_stock.max' => '在庫がマイナスになります。',
                ]
            );
            $new_stock = $now_stock - $fluctuating_stock;
            Stock::where('shop_id', $move_shop)->where('item_id', $item->id)->update([
                'stock' => $new_stock
            ]);
            
            return redirect()->route('home');
        }

    }
}
