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
        for ($i = 0; $i < count($arrayNameBrand); $i++) {
            DB::table('brands')->insert([
                'name' => $arrayNameBrand[$i],
            ]);
        }

    }
}
