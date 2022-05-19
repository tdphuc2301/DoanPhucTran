<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayNameCategory = ['Android', 'Iphone(IOS)', 'Điên thoại phổ thông'];

        for ($i = 0; $i < count($arrayNameCategory); $i++) {
            DB::table('categories')->insert([
                'name' => $arrayNameCategory[$i],
            ]);
        }
    }
}
