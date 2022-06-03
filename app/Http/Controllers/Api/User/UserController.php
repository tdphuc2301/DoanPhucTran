<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Traits\Lib;

class UserController extends Controller
{
    public function update(Request $request) {
        $user = User::find($request->id);
        if (Hash::check($request->password_old,$user->password)) {
            if($request->password === $request->confirm_password) {
                $user->password = Hash::make($request->password);
                $user->save();
                return $this->responseOK($user);
            } else {
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            }
        } else {
            return $this->responseError(Response::HTTP_BAD_REQUEST);
        }
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
