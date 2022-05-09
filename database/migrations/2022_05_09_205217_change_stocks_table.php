<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('UPDATE `stocks` SET `user_id` = 1 WHERE `user_id` IS NULL');
        DB::statement('UPDATE `stocks` SET `stock_item_name` = "" WHERE `stock_item_name` IS NULL');
        DB::statement('UPDATE `stocks` SET `quantity` = 0 WHERE `quantity` IS NULL');

        Schema::table('stocks', function (Blueprint $table) {
            // noteカラムにNULLを許容
            $table->text('user_id')->nullable(false)->change();
            $table->text('stock_item_name')->nullable(false)->change();
            $table->text('quantity')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->text('user_id')->nullable()->change();
            $table->text('stock_item_name')->nullable()->change();
            $table->text('quantity')->nullable()->change();
        });
    }
}
