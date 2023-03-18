<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'items' , 'as' => 'item.'], function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->name('index');
});

// 客注システム
Route::group(['prefix' => 'orders' , 'as' => 'order.'], function () {
    // ③移動先選択画面の表示
    Route::get('/get', [App\Http\Controllers\OrderController::class, 'getShow'])->name('getShow');
    // ④移動先にアイテムを渡す
    Route::post('/get', [App\Http\Controllers\OrderController::class, 'get'])->name('get');
    // ⑤上のpostで客注キャンセルをした場合、キャンセル完了画面へ遷移
    Route::get('/cancel', [App\Http\Controllers\OrderController::class, 'cancelShow'])->name('cancelShow');
    // ①選択した商品の移動数入力画面の表示
    Route::get('/{id}', [App\Http\Controllers\OrderController::class, 'add'])->name('add');
    // ②商品が移動されるメソッド(移動される分、在庫数を減らす仕組み)
    Route::post('{id}', [App\Http\Controllers\OrderController::class, 'lost'])->name('lost');
});

// 問い合わせ
Route::group(['prefix' => 'contact' , 'as' => 'contact.'], function () {
    // ①問い合わせ画面表示
    Route::get('/', [App\Http\Controllers\ContactsController::class, 'index'])->name('index');
    // ②内容をpostし、入力内容確認画面へ遷移
    Route::post('/confirm', [App\Http\Controllers\ContactsController::class, 'confirm'])->name('confirm');
    // ③問い合わせ内容を送信し、送信完了画面へ遷移
    Route::post('/thanks', [App\Http\Controllers\ContactsController::class, 'send'])->name('send');
});

// ↓管理者権限をもった人のみアクセス可能(roleが2の人のみ(AuthServiceProvider.phpにて設定済))
Route::group(['middleware' => 'can:admin' , 'prefix' => 'items' , 'as' => 'item.'], function () {
    // ①商品登録画面表示
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add'])->name('add');
    // ②入力後→登録内容確認画面へ遷移
    Route::post('/confirm', [App\Http\Controllers\ItemController::class, 'confirm'])->name('confirm');
    // ③登録画面へ戻るor登録完了画面へ遷移
    Route::post('/thanks', [App\Http\Controllers\ItemController::class, 'store'])->name('store');
    // ④登録完了画面の表示
    Route::get('/thanks', [App\Http\Controllers\ItemController::class, 'showThanks'])->name('showThanks');
    // ⑤商品の詳細画面へ遷移
    Route::get('/{id}', [App\Http\Controllers\ItemController::class, 'detail'])->name('detail');
    // ⑥商品の更新機能 更新後、ホーム画面へ遷移する
    Route::post('/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('update');
    // ⑦商品の削除機能 削除後、ホーム画面へ遷移する
    Route::post('/{id}/delete', [App\Http\Controllers\ItemController::class, 'delete'])->name('delete');
});

Route::group(['middleware' => 'can:admin' , 'prefix' => 'shops' , 'as' => 'shop.'], function () {
    // ①店舗の登録画面表示
    Route::get('/add', [App\Http\Controllers\ShopController::class, 'add'])->name('add');
    // ②店舗の登録機能 登録後、ホーム画面へ遷移
    Route::post('/thanks', [App\Http\Controllers\ShopController::class, 'store'])->name('store');
    // ③登録完了画面の表示
    Route::get('/thanks', [App\Http\Controllers\ShopController::class, 'showThanks'])->name('showThanks');
});

Route::group(['middleware' => 'can:admin' , 'prefix' => 'accounts' , 'as' => 'account.'], function () {
    // ①ユーザー一覧画面表示
    Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('index');
    // ②ユーザーの更新画面へ遷移
    Route::get('/{id}', [App\Http\Controllers\AccountController::class, 'detail'])->name('detail');
    // ③ユーザーの更新機能 更新後、ホーム画面へ遷移
    Route::post('/{id}', [App\Http\Controllers\AccountController::class, 'update'])->name('update');
    // ④ユーザーの削除機能 削除後、ホーム画面へ遷移する
    Route::post('/{id}/delete', [App\Http\Controllers\AccountController::class, 'delete'])->name('delete');
});
