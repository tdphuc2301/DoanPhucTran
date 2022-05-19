<?php

namespace App\Http\Controllers\Traits;

use Throwable;

trait Lib
{
    protected $res = [
        'status' => 200,
        'data' => [],
        'error' => [],
        'success' => true,
        'message' => ''
    ];

    public function setResponse($data)
    {

        if (isset($data['data']) && $data['data']) {
            $this->res['data'] = $data['data'];
        }
        if (isset($data['message'])) {
            $this->res['message'] = $data['message'];
        }
        if (isset($data['error']) && $data['error']) {
            $this->res['error'] = $data['error'];
            $this->res['success'] = false;
        }
        if (isset($data['status'])) {
            $this->res['status'] = $data['status'];
        }
        if (isset($data['success'])) {
            $this->res['success'] = $data['success'];
        }
        return response()->json($this->res, $this->res['status'], []);
    }

    public function responseOK($data = null, string $message = 'Thành công', $response_code = 200)
    {
        return response()->json(
            [
                'success' => true,
                'data' => $data,
                'message' => $message
            ],
            $response_code
        );
    }

    public function responseError(
        $errorCode = 400,
        Throwable $exception = null,
        string $message = '',
        array $data = null
    ) {
        if($exception){
            report($exception);
            $message = !empty($message) ? $message : $exception->getMessage();
        }
        return response()->json(
            [
                'success' => false,
                'data' => $data,
                'message' => $message
            ],
            $errorCode
        );
    }
}
