<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypePromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayNameTypePromotion = ['money', 'percent'];

        for ($i = 0; $i < count($arrayNameTypePromotion); $i++) {
            DB::table('categories')->insert([
                'name' => $arrayNameTypePromotion[$i]
            ]);
        }
    }
}
