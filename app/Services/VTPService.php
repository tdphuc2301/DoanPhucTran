<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 7/14/2020
 * Time: 11:51 AM
 */

namespace App\Services;

use App\Http\Requests\GiaoHangNhanh\CreateOrderRequest;
use App\Http\Requests\GiaoHangNhanh\HeaderRequest;
use App\Models\DeliveryPartner;
use Illuminate\Http\Request;

class VTPService
{
    private $token;
    protected $vtp_url;

    public function __construct()
    {
        $this->vtp_url = config('delivery.vtp.url');
        $this->token = 'eyJhbGciOiJFUzI1NiJ9.eyJVc2VySWQiOjk1MzU2MDIsIkZyb21Tb3VyY2UiOjEsIlRva2VuIjoiMUMwMzNBNUZBN0NFNTU3MkIwMzBEMkU1MDZCMkJFNjEiLCJleHAiOjE2NTU0MzMzNzQsIlBhcnRuZXIiOjB9.5gJasghI9Mlp1nlygGJsXyuPZvYRCBsW8ksXgSyr68OX9LPpfj2OvxRuLCt0_yP0aXaxChs0XW89vGa8-fRjtQ';
    }

    public function getProvince(){
        try {
            $rs = $this->curlUrlVTP('categories/listProvinceById?provinceId=-1',[],"GET");
            return [
                'success' => true,
                'data' => $rs,
                'message' => '',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'data' => [],
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getDistrict($province_id){
        try {
            $rs = $this->curlUrlVTP('categories/listDistrict?provinceId='.$province_id,[],"GET");
            return [
                'success' => true,
                'data' => $rs,
                'message' => '',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'data' => [],
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getWard($district_id){
        try {
            $rs = $this->curlUrlVTP('categories/listWards?districtId='.$district_id,[],"GET");
            return [
                'success' => true,
                'data' => $rs,
                'message' => '',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'data' => [],
                'message' => $e->getMessage(),
            ];
        }
    }

    protected function curlUrlVTP($path, $param = [], $method = "POST", $header = [])
    {
        $token = isset($param['token']) ? $param['token']:  $this->token;
        $url = !empty($param['host']) ? $param['host'].$path :   $this->vtp_url. $path;
        $param = json_encode($param);
        if(empty($header)){
            $header = array(
                "Content-Type: application/json",
                "token: $token"
            );
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => $param,
            CURLOPT_HTTPHEADER => $header,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

}
