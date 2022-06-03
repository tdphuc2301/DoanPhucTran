<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayNameBranch = [
            'CHI NHANH 1',
            'CHI NHANH 2',
            'CHI NHANH 3',
        ];
        $arrayAddressBranch = [
            'Thành phố Hồ Chí Minh',
            'Thành phố HA NOI',
            'Thành phố QUI NHON',
        ];

        $arrayLongBranch = [
            '123.45',
            '456.57',
            '678.23',
        ];
        $arrayLatBranch = [
            '123.45',
            '456.57',
            '678.23',
        ];

        for ($i = 0; $i < count($arrayNameBranch); $i++) {
            DB::table('branchs')->insert([
                'name' => $arrayNameBranch[$i],
                'address' => $arrayAddressBranch[$i],
                'long' => $arrayLongBranch[$i],
                'lat' => $arrayLatBranch[$i]
            ]);
        }
    }
}
