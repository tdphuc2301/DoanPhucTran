<?php

namespace App\Http\Controllers\Api\Upload;

use App\Http\Services\UploadImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadImageController
{

    public function uploadImage(Request $request, UploadImageService $uploadImageService)
    {
        $data = $request->all();
        writeLog('stack', json_encode($data));
    }

    public function uploadImageCkeditor(Request $request, UploadImageService $uploadImageService)
    {
        $dataCkeditor = [
            'url' => '',
            'message' => ''
        ];
        $validator = Validator::make($request->all(),[
            'ckCsrfToken' => 'required',
            'CKEditorFuncNum' => 'required',
            'upload' => 'required',
        ]);
        if($validator->fails()){
            $dataCkeditor['message'] = 'Xảy ra lỗi upload hình !!!';
        }else{
            if (isUploadFile($request->upload ?? null)) {
                $uploadImage = $uploadImageService
                    ->setModule('ckeditor')
                    ->uploadImage($request->upload, null, true);
                if ($uploadImage->isSuccess()) {
                    $uploadImage = $uploadImage->getData();
                    $dataCkeditor['url'] = asset($uploadImage['path']);
                } else {
                    $dataCkeditor['message'] = $uploadImage->getMessage();
                }
            }else{
                $dataCkeditor['message'] = 'Vui lòng chọn hình !';

            }
        }
        return view('components.ckeditor-upload', [
            'CKEditorFuncNum' => $request->CKEditorFuncNum,
            'data' => $dataCkeditor
        ]);
    }
}
