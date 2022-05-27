<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 7/14/2020
 * Time: 11:51 AM
 */

namespace App\Services;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JTService
{
    protected $jt_url;
    protected $key;
    protected $eccompanyid;
    protected $wrong_customerid_status = [
        "B042", "B041", "B038"
    ];

    public function __construct()
    {
        $this->jt_url = config('delivery.jt.dev_url');
        $this->key = '797e2045c18c72f02ef0e67a9b4d3e2b';
        $this->eccompanyid = 'CHOTDONVN';
    }
    protected function setKey($key){
        $this->key = $key;
    }
    /**
     * Kết nối
     * @param
     * @return
     */
    public function connect()
    {
        try {
//            $this->setKey($key);
            $data = [
                'weight' => 1,
                'destareacode' => 'Thị trấn Tây Đằng-024HBV01',
                'sendsitecode' => 'Quận 1',
                'feetype' => 'CHARGE',
                'producttype' => ''
            ];
            $params = [
                'logistics_interface' => $data,
                'data_digest' => $this->jtEncode($data),
                'msg_type' => 'FREIGHTQUERY',
                'eccompanyid' => $this->eccompanyid
            ];
            $rs = $this->curlUrlJT('standard/inquiry!newFreight.action', $params, "POST");
            if (isset($rs['responseitems'][0]['success']) && $rs['responseitems'][0]['success'] == "true") {
                return [
                    'message' => _trans('Kết nối thành công'),
                    'success' => true
                ];
            }
            return [
                'message' => __('Token không hợp lệ'),
                'success' => false
            ];

        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'data' => [],
                'success' => false
            ];
        }
    }


    /**
     * Tạo đơn hàng
     * @param
     * @return
     */
    public function createOrder($data = [])
    {
        try {
            $data['eccompanyid'] = $this->eccompanyid;
            $params = [
                'logistics_interface' => $data,
                'data_digest' => $this->jtEncode($data),
                'msg_type' => 'ORDERCREATE',
                'eccompanyid' => $this->eccompanyid
            ];
            $rs = $this->curlUrlJT('order/orderAction!createOrder.action', $params, "POST");
            if (isset($rs['responseitems'][0]['success']) && $rs['responseitems'][0]['success'] == "true") {
                if (isset($rs['responseitems'][0]['reason']) && $rs['responseitems'][0]['reason'] == 'S10') {
                    return [
                        'message' => _trans('Hoá đơn này đã được tạo đơn vận trước đó'),
                        'data' => [],
                        'success' => false
                    ];
                }
                return [
                    'message' => _trans('thành công'),
                    'data' =>[
                        'delivery_code' =>  $rs['responseitems'][0]['billcode'],
                        'total_fee' =>  (int)$rs['responseitems'][0]['inquiryFee'],
                    ],
                    'success' => true
                ];
            }
            if (isset($rs['responseitems'][0]['reason'])) {
                if(in_array($rs['responseitems'][0]['reason'], $this->wrong_customerid_status)){
                    return [
                        'message' => _trans('Customer ID không hợp lệ. Vui lòng kết nối lại'),
                        'data' => [],
                        'success' => false,
                        'sub_error'=>$rs,
                    ];
                }

                if($rs['responseitems'][0]['reason'] == 'B030'){
                    return [
                        'message' => _trans('Không hỗ trợ giao từ địa chỉ này'),
                        'data' => [],
                        'success' => false
                    ];
                }
            }

            return [
                'sub_error'=>$rs,
                'message' => __('Thất bại'),
                'data' => [],
                'success' => false
            ];

        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'data' => [],
                'success' => false
            ];
        }
    }

    /**
     * Hủy đơn hàng
     * @param
     * @return
     */
    public function cancelOrder($data)
    {
        try {
            $data['eccompanyid'] = $this->eccompanyid;
            $params = [
                'logistics_interface' => ($data),
                'data_digest' => $this->jtEncode($data),
                'msg_type' => 'UPDATE',
                'eccompanyid' => $this->eccompanyid
            ];;
            $rs = $this->curlUrlJT('order/orderAction!createOrder.action', $params, "POST");
            if (isset($rs['responseitems'][0]['success']) && $rs['responseitems'][0]['success'] == "true") {
                return [
                    'message' => _trans('Thành công'),
                    'data' =>[],
                    'success' => true
                ];
            }

            if (isset($rs['responseitems'][0]['reason'])) {
                if(in_array($rs['responseitems'][0]['reason'], $this->wrong_customerid_status)){
                    return [
                        'message' => _trans('Customer ID không hợp lệ. Vui lòng kết nối lại'),
                        'data' => [],
                        'success' => false
                    ];
                }
            }

            $error_code = isset($rs['responseitems'][0]['reason']) ? $rs['responseitems'][0]['reason'] : '';
            return [
                'message' => __('Không thể hủy đơn này. Error_code:  '. $error_code),
                'data' => [],
                'success' => false
            ];

        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'data' => [],
                'success' => false
            ];
        }
    }

    /**
     * Lấy thông tin đơn vận
     * @param
     * @return
     */
    public function getOrderInfo($data)
    {
        try {
            $data['eccompanyid'] = $this->eccompanyid;
            $params = [
                'logistics_interface' => ($data),
                'data_digest' => $this->jtEncode($data),
                'msg_type' => 'TRACKQUERY',
                'eccompanyid' => $this->eccompanyid
            ];
            $rs = $this->curlUrlJT('standart/trackAction!trackForJson.action', $params, "POST");
            if (isset($rs['responseitems'][0]['success']) && $rs['responseitems'][0]['success'] == "true") {
                return [
                    'message' => _trans('Thành công'),
                    'data' => $rs['responseitems'][0]['tracesList'][0]['details'] ?? [],
                    'success' => true
                ];
            }

            if (isset($rs['responseitems'][0]['reason'])) {
                if(in_array($rs['responseitems'][0]['reason'], $this->wrong_customerid_status)){
                    return [
                        'message' => _trans('Customer ID không hợp lệ. Vui lòng kết nối lại'),
                        'data' => [],
                        'success' => false
                    ];
                }
            }

            $error_code = isset($rs['responseitems'][0]['reason']) ? $rs['responseitems'][0]['reason'] : '';
            return [
                'message' => __('Thất bại. Error_code:  '. $error_code),
                'data' => [],
                'success' => false
            ];

        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'data' => [],
                'success' => false
            ];
        }
    }

    /**
     * Tính phí
     * @param
     * @return
     */
    public function calculateFee($data = [])
    {
        try {
            $params = [
                'logistics_interface' => $data,
                'data_digest' => $this->jtEncode($data),
                'msg_type' => 'FREIGHTQUERY',
                'eccompanyid' => $this->eccompanyid
            ];
            $rs = $this->curlUrlJT('standard/inquiry!newFreight.action', $params, "POST");
//            return $rs;
            if (isset($rs['responseitems'][0]['success']) && $rs['responseitems'][0]['success'] == "true") {
                return [
                    'message' => null,
                    'data' => (int)$rs['responseitems'][0]['inquiryfee'],
                    'success' => true
                ];
            }

            $error_code = isset($rs['responseitems'][0]['reason']) ? $rs['responseitems'][0]['reason'] : '';
            return [
                'message' => __('Thất bại. Error_code:  '. $error_code),
                'data' => [],
                'success' => false
            ];

        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'data' => [],
                'success' => false
            ];
        }
    }

    protected function curlUrlJT($path, $param = [], $method = "POST")
    {
        $url = $this->jt_url . $path;
        $param['logistics_interface'] = json_encode($param['logistics_interface']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => $param,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public function jtEncode($logistics_interface)
    {
        return base64_encode(md5(json_encode($logistics_interface) . $this->key));
    }

}
