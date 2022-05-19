<?php

namespace Database\Seeders;

use App\Models\Ram;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Customer::factory(10)->create();
//        $this->call(RamSeeder::class);
//        $this->call(RomSeeder::class);
//        $this->call(PriceSeeder::class);
//        $this->call(ColorSeeder::class);
//        $this->call(CategorySeeder::class);
//        $this->call(BranchSeeder::class);
        $this->call(BrandSeeder::class);
    }
}
