<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayNameTypeCustomer = ['Hạng đồng', 'Hạng vàng', 'Hạng kim cương','Vip pro'];

        for ($i = 0; $i < count($arrayNameTypeCustomer); $i++) {
            DB::table('type_customers')->insert([
                'name' => $arrayNameTypeCustomer[$i],
                'search'=> $arrayNameTypeCustomer[$i]
            ]);
        }
    }
}
