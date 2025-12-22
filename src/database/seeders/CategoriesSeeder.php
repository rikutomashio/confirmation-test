<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => '商品のお届けについて'],
            ['category_name' => '商品の交換について'],
            ['category_name' => '商品トラブル'],
            ['category_name' => 'ショップへのお問い合わせ'],
            ['category_name' => 'その他'],
        ]);

    }
}
