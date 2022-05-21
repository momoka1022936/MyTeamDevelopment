<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('needs')->insert([
            [
                'user_id' => '1',
                'need_item_name' => 'サーモン',
                'quantity' => '2',
                'date_of_purchase' => '2022/08/10'
            ],[
                'user_id' => '1',
                'need_item_name' => 'マグロ',
                'quantity' => '2',
                'date_of_purchase' => '2022/08/10'
            ],[
                'user_id' => '1',
                'need_item_name' => 'タイ',
                'quantity' => '2',
                'date_of_purchase' => '2022/08/10'
            ],[
                'user_id' => '1',
                'need_item_name' => '玉子',
                'quantity' => '2',
                'date_of_purchase' => '2022/08/10'
            ],[
                'user_id' => '1',
                'need_item_name' => 'アジ',
                'quantity' => '2',
                'date_of_purchase' => '2022/08/10'
            ],
        ]);
    }
}
