<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_categories')->insert([
            [
                'name' => '花・観葉植物',
                'sort_order' => 1,
            ],
            [
                'name' => 'エクステリア・ガーデンファニチャー',
                'sort_order' => 2,
            ],
            [
                'name' => 'ガーデニング・農業',
                'sort_order' => 3,
            ],
        ]);

        DB::table('secondary_categories')->insert([
            [
                'name' => '観葉植物',
                'sort_order' => 1,
                'primary_category_id' => 1,
            ],
            [
                'name' => '鉢花',
                'sort_order' => 2,
                'primary_category_id' => 1,
            ],
            [
                'name' => 'プリザーブドフラワー',
                'sort_order' => 3,
                'primary_category_id' => 1,
            ],
            [
                'name' => 'フラワーアレンジメント',
                'sort_order' => 4,
                'primary_category_id' => 1,
            ],
            [
                'name' => 'ガーデンオーナメント',
                'sort_order' => 5,
                'primary_category_id' => 2,
            ],
            [
                'name' => 'ガレージ',
                'sort_order' => 6,
                'primary_category_id' => 2,
            ],
        ]);




    }
}
