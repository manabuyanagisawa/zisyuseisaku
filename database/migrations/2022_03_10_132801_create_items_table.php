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
            $table->id();
            $table->bigInteger('user_id')->comment('登録者');
            $table->bigInteger('update_user_id')->nullable()->comment('更新者');
            $table->string('name',100)->comment('商品名');
            $table->smallInteger('status')->default('1')->comment('ステータス');
            $table->smallInteger('price')->comment('値段');
            $table->smallInteger('type')->comment('種別');
            $table->smallInteger('brand')->comment('ブランド');
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
