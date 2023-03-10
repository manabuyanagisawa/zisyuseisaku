<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Shop;

class OrderController extends Controller
{
    // ①客注画面の表示
    public function add($id){
        $order_item = Item::find($id);
        $shop = Shop::all();
        return view('order.add',compact('order_item','shop'));
    }
}
