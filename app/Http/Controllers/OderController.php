<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Shop;

class OderController extends Controller
{
    // ①客注画面の表示
    public function add($id){
        $oder_item = Item::find($id);
        $shop = Shop::all();
        return view('oder.add',compact('oder_item','shop'));
    }
}
