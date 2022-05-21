<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('stocks')->insert([
            
            [
                'user_id' => '1',
                'stock_item_name' => 'カレールー',
                'quantity' => '2',
                'alert_number' => '1',
                'stock_expiration' => '2022/08/10'
            ],
            [
                'user_id' => '1',
                'stock_item_name' => 'ジャガイモ',
                'quantity' => '4',
                'alert_number' => '1',
                'stock_expiration' => '2022/08/10'
            ],
            [
                'user_id' => '1',
                'stock_item_name' => '人参',
                'quantity' => '1',
                'alert_number' => '3',
                'stock_expiration' => '2022/08/10'
            ],
            [
                'user_id' => '1',
                'stock_item_name' => '玉葱',
                'quantity' => '3',
                'alert_number' => '1',
                'stock_expiration' => '2022/08/10'
            ],[
                'user_id' => '1',
                'stock_item_name' => 'リンゴ',
                'quantity' => '1',
                'alert_number' => '1',
                'stock_expiration' => '2022/08/10'
            ],
            [
                'user_id' => '1',
                'stock_item_name' => 'シラス',
                'quantity' => '1',
                'alert_number' => '1',
                'stock_expiration' => '2022/08/10'
            ],[
                'user_id' => '1',
                'stock_item_name' => 'たけのこの里',
                'quantity' => '1',
                'alert_number' => '1',
                'stock_expiration' => '2022/08/10'
            ],[
                'user_id' => '1',
                'stock_item_name' => 'きのこの山',
                'quantity' => '1',
                'alert_number' => '1',
                'stock_expiration' => '2022/08/10'
            ],[
                'user_id' => '1',
                'stock_item_name' => 'ポテトチップス',
                'quantity' => '1',
                'alert_number' => '1',
                'stock_expiration' => '2022/08/10'
            ],
         ]);
    }
}
