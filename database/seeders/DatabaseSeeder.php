<?php

namespace Database\Seeders;

use App\Models\Ram;
use App\Models\TypePromotion;
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
        $this->call(RamSeeder::class);
        $this->call(RomSeeder::class);
        $this->call(PriceSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TypeCustomerSeeder::class);
        // $this->call(BranchSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(TypePromotionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(ReportSeeder::class);
    }
}
