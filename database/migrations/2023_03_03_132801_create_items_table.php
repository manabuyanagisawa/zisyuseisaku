<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            // foreignId('名前')->constrained('マイグレーションファイル名')->comment('コメント');→外部キー制約
            $table->id();
            $table->foreignId('user_id')->constrained('users')->comment('登録者');
            $table->foreignId('update_user_id')->nullable()->constrained('users')->comment('更新者');
            $table->foreignId('shop_id')->constrained('shops')->comment('店舗ID');
            $table->string('name',100)->comment('商品名');
            $table->smallInteger('price')->comment('値段');
            $table->smallInteger('type')->comment('種別');
            $table->smallInteger('brand')->comment('ブランド');
            $table->smallInteger('wear_size')->nullable()->comment('ウェアサイズ'); // 1:XS 2:S 3:M 4:L 5:XL
            $table->smallInteger('color')->comment('カラー'); // 1:黒 2:赤 3:黄　4:青 5:緑 6:白 7:その他
            $table->bigInteger('stock')->nullable()->comment('在庫数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
