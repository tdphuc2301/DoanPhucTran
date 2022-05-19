<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayNameRom = [
            '8GB',
            '16GB',
            '32GB',
            '64GB',
            '128GB',
            '256GB',
            '512GB',
        ];

        $arrayCapacityRom = [
            8,
            16,
            32,
            64,
            128,
            256,
            512
        ];

        for ($i = 0; $i < count($arrayNameRom); $i++) {
            DB::table('roms')->insert([
                'name' => $arrayNameRom[$i],
                'capacity' => $arrayCapacityRom[$i],
            ]);
        }
    }
}
