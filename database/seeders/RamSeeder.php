<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayNameRam = [
            '2GB',
            '3GB',
            '4GB',
            '6GB',
            '8GB',
            '12GB',
        ];
        
        $arrayCapacityRam = [
            2,
            3,
            4,
            6,
            8,
            12
        ];

        for ($i = 0; $i < count($arrayNameRam); $i++) {
            DB::table('rams')->insert([
                'name' => $arrayNameRam[$i],
                'capacity' => $arrayCapacityRam[$i],
            ]);
        }
    }
}
