<?php
namespace App\Http\Controllers\Api\Address;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Lib;
use App\Imports\AddressImport;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Services\VTPService;
use Maatwebsite\Excel\Facades\Excel;
use \Illuminate\Support\Str;

class AddressController extends Controller {
    use Lib;
    public function __construct(){

    }

    public function getProvince(){
        $provinces = Province::all();
        return $this->setResponse([
               'data' => $provinces,
           ]
        );
    }

    public function getDistrict(){
        if(empty(\request()->province_id)){
            return $this->setResponse([
                   'success' => false,
                   'message' => 'Vui lòng chọn tỉnh thành',
               ]
            );
        }
        $districts = District::where('province_id', \request()->province_id)->get();
        return $this->setResponse([
                'data' => $districts,
            ]
        );
    }

    public function getWard(){
        if(empty(\request()->district_id)){
            return $this->setResponse([
                    'success' => false,
                    'message' => 'Vui lòng chọn quận huyện',
                ]
            );
        }
        $wards = Ward::where('district_id', \request()->district_id)->get();
        return $this->setResponse([
                'data' => $wards,
            ]
        );
    }
}
