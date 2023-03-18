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
            $now_stock = Stock::where('shop_id', $shop_id)->
                                where('item_id', $item->id)->first()->stock;
            $new_stock = $now_stock + $request->input('stock');
            Stock::where('item_id', $item->id)->update([
                'stock'=> $new_stock
            ]);
        }else{
            Stock::create([
                'item_id' => $item->id,
                'shop_id' => $request->shop_id,
                'stock' => $request->stock,
            ]);}

        return redirect()->route('home');
    
    }
}