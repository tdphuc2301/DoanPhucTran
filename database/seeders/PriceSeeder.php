<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayNamePrice = [
            'Dưới 2 triệu',
            'Từ 2 triệu đếns 4 triệu',
            'Từ 4 triệu dến 7 triệu',
            'Từ 7 triệu dến 13 triệu',
            'Từ 13 triệu dến 20 triệu',
            'Trên 20 triệu'
        ];
        $arrayBegin = [
            0,
            2000000,
            4000000,
            7000000,
            13000000,
            2000000
        ];

        $arrayEnd = [
            2000000,
            4000000,
            7000000,
            13000000,
            20000000,
            100000000
        ];
        for ($i = 0; $i < count($arrayNamePrice); $i++) {
            DB::table('prices')->insert([
                'name' => $arrayNamePrice[$i],
                'begin' => $arrayBegin[$i],
                'end' => $arrayEnd[$i],
            ]);
        }
    }
}
