<?php
namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Lib;
use App\Imports\AddressImport;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Services\VTPService;
use Maatwebsite\Excel\Facades\Excel;
use \Illuminate\Support\Str;

class DeliveryController extends Controller {
    use Lib;
    protected $VTPService;
    public function __construct(){
        $this->VTPService = new VTPService();
    }
    public function mapProvinceJT()
    {
        $address_list = Excel::toArray(new AddressImport, public_path('Export-Adress.xlsx'));
        $address_list = $address_list[0];
        foreach ($address_list as $index => $address) {
            if ($index == 0) {
                continue;
            }
            $data_create_province = [
                'name' => $address[0],
                'search' => Str::slug($address[0],' '),
                'alias' => Str::slug($address[0],'-'),
            ];
            $province = Province::where('name', $data_create_province['name'])->first();
            if(!$province){
                $province = Province::create($data_create_province);
            }

            $alias_district = $district_name = $address[1];
            if (preg_match('/(.*)(\(.*\))/i', $alias_district, $output_array)) {
                $alias_district = $district_name = $output_array[1];
            }
            $regex = preg_match('/(Quận|Huyện Đảo|Huyện|Thành phố|Thị xã)(.*)/i', $alias_district, $output_array);
            if ($regex) {
                $alias_district = $output_array[2];
            }
            $data_create_district = [
                'name' => $district_name,
                'code' => $address[1],
                'search' => Str::slug($alias_district,' '),
                'alias' => Str::slug($alias_district,'-'),
                'province_id' => $province['id']
            ];
            $district = District::where('province_id', $province['id'])->where('name', $data_create_district['name'])->first();
            if(!$district){
                $district = District::create($data_create_district);
            }

            $alias_ward = $ward_name= $address[2];
            if (preg_match('/(.*)(-.*)/i', $alias_ward, $output_array)) {
                $alias_ward = $ward_name = $output_array[1];
            }
            $regex = preg_match('/(Xã|Phường|Thị trấn|Huyện Đảo)(.*)/i', $alias_ward, $output_array);
            if ($regex) {
                $alias_ward = $output_array[2];
            }
            $data_create_ward = [
                'name' => $ward_name,
                'code' => $address[2],
                'search' => Str::slug($alias_ward,' '),
                'alias' => Str::slug($alias_ward,'-'),
                'district_id' => $district['id']
            ];
            $ward = Ward::where('district_id',$district['id'])->where('code', $data_create_ward['code'])->first();
            if(!$ward){
                $ward = Ward::create($data_create_district);
            }
        }
    }
}
