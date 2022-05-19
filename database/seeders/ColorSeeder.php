<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayNameColor = [
            'Đen',
            'Bạc',
            'Xám',
            'Xanh Rêu',
            'Trắng',
            'Đỏ',
        ];

        $arrayCodeNameColor = [
            '#111;',
            '#d5cece',
            '#b5a7a7',
            '#527c4c',
            '#fff',
            '#e52c2c'
        ];

        for ($i = 0; $i < count($arrayNameColor); $i++) {
            DB::table('colors')->insert([
                'name' => $arrayNameColor[$i],
                'color_code' => $arrayCodeNameColor[$i],
            ]);
        }
    }
}
