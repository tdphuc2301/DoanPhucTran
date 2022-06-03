<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('reports')->insert([
            'total_price' => 10,
            'total_order' => 10,
            'date_created' => date("Y/m/d"),
            'branch_id'=> 1
        ]);
        
    }
}
