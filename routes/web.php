<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

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
