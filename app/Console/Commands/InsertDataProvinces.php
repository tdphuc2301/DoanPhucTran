<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class InsertDataProvinces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:dataProvince';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        set_time_limit(5000);
        $url = 'https://provinces.open-api.vn/api/?depth=3';
        $response = Http::timeout(60)->get($url);
        $response = $response->json();
        foreach ($response as $item) {
            $newProvince = [
                'name' => $item['name'],
                'search' => str_replace('_', ' ', $item['codename']),
                'province_code' => $item['codename'],
            ];
            Province::create($newProvince);

            $listDistrict = $item['districts'];
            foreach ($listDistrict as $district) {
                $newDistrict = [
                    'name' => $district['name'],
                    'search' => str_replace('_', ' ', $item['codename']),
                    'province_code' => $item['codename'],
                    'district_code' => $district['codename'],
                ];
                District::create($newDistrict);
                $listWard = $district['wards'];
                foreach ($listWard as $ward) {
                    $newWard = [
                        'name' => $ward['name'],
                        'search' => str_replace('_', ' ', $ward['codename']),
                        'ward_code' => $ward['codename'],
                        'district_code' => $district['codename'],
                    ];
                    Ward::create($newWard);
                }
            }
        }
        return 0;
    }
}
