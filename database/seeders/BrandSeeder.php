<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayNameBrand = ['iphone', 'samsung', 'oppo', 'vivo', 'xiaomi', 'realme', 'nokia', 'itel', 'masstel'];
        $arrayLogoBrand = [
            'https://cdn.tgdd.vn/Brand/1/logo-iphone-220x48.png',
            'https://cdn.tgdd.vn/Brand/1/samsungnew-220x48-1.png',
            'https://cdn.tgdd.vn/Brand/1/OPPO42-b_5.jpg',
            'https://cdn.tgdd.vn/Brand/1/vivo-logo-220-220x48-3.png',
            'https://cdn.tgdd.vn/Brand/1/logo-xiaomi-220x48-5.png',
            'https://cdn.tgdd.vn/Brand/1/Realme42-b_37.png',
            'https://cdn.tgdd.vn/Brand/1/Nokia42-b_21.jpg',
            'https://cdn.tgdd.vn/Brand/1/Itel42-b_54.jpg',
            'https://cdn.tgdd.vn/Brand/1/Masstel42-b_0.png'
        ];
        for ($i = 0; $i < count($arrayNameBrand); $i++) {
            DB::table('brands')->insert([
                'name' => $arrayNameBrand[$i],
                'logo' => $arrayLogoBrand[$i],
            ]);
        }

    }
}
