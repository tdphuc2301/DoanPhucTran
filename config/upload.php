<?php
return [
    'tinify_key' =>'W3dsF9K89305YCyWGFCqBwCkdnGLpSkQ',
    'upload_image_path' => 'upload/images/%s/%dx%d',
    'max_image_size' => 5, // MB
    'allowed_image_extensions' => ['jpg', 'png', 'jpeg'],
    'response_code' => [
        'invalid_image_extension' => 'invalid_image_extension',
        'invalid_image_size' => 'invalid_image_size',
        'success' => 'success',
        'file_not_exist' => 'file_not_exist',
        'upload_fail' => 'upload_fail',
    ],
    'response_message' => [
        'invalid_image_extension' => 'File không hợp lệ. Vui lòng chọn file ảnh.',
        'invalid_image_size' => 'Vui lòng chọn hình có dung lượng thấp hơn %d MB',
        'success' => 'Thành công',
        'file_not_exist' => 'File không tồn tại',
        'upload_fail' => 'Upload hình thất bại',
    ],
    'log_channel' => 'log_upload_image',
];
