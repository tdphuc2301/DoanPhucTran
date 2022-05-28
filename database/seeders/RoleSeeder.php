<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayNameRole = ['Manager', 'Admin', 'shipper','customer'];

        for ($i = 0; $i < count($arrayNameRole); $i++) {
            DB::table('type_promotions')->insert([
                'name' => $arrayNameRole[$i],
            ]);
        }
    }
}
