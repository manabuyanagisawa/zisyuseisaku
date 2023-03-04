<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'items' , 'as' => 'item.'], function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->name('index');
    // ①商品登録画面表示
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add'])->name('add');
    // ②入力後→登録内容確認画面へ遷移
    Route::post('/confirm', [App\Http\Controllers\ItemController::class, 'confirm'])->name('confirm');
    // ③登録画面へ戻るor登録完了画面へ遷移
    Route::post('/thanks', [App\Http\Controllers\ItemController::class, 'store'])->name('store');
    // ④登録完了画面の表示
    Route::get('/thanks', [App\Http\Controllers\ItemController::class, 'showThanks'])->name('showThanks');
});

// ↓管理者権限をもった人のみアクセス可能(roleが2の人のみ(AuthServiceProvider.phpにて設定済))
Route::group(['middleware' => 'can:admin' , 'prefix' => 'items' , 'as' => 'item.'], function () {
    // ⑤商品の詳細画面へ遷移
    Route::get('/{id}', [App\Http\Controllers\ItemController::class, 'detail'])->name('detail');
    // ⑥商品の更新機能 更新後、ホーム画面へ遷移する
    Route::post('/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('update');
    // ⑦商品の削除機能 削除後、ホーム画面へ遷移する
    Route::post('/{id}/delete', [App\Http\Controllers\ItemController::class, 'delete'])->name('delete');
});
