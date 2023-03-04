<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id()->comment('店舗ID');
            $table->string('name',100)->comment('店名');
            $table->bigInteger('item_id')->comment('商品ID');
            $table->smallInteger('wear_size')->nullable()->comment('ウェアサイズ'); // 1:XS 2:S 3:M 4:L 5:XL
            $table->smallInteger('color')->comment('カラー'); // 1:黒 2:赤 3:黄　4:青 5:緑 6:白 7:その他
            $table->bigInteger('stock')->nullable()->name('在庫数');
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
        Schema::dropIfExists('shops');
    }
}
