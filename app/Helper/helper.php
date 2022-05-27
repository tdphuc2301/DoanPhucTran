<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

function uploadFile($data = [], $is_image = false)
{
    try {
        $path = isset($data['path']) ? $data['path'] : '/upload';
        if (!is_dir(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }
        if (!empty($data['file'])) {
            if ($is_image) {
                $validate_image = validateImage($data['file']);
                if (!$validate_image['success']) {
                    return [
                        'status' => 200,
                        'message' => $validate_image['message'],
                        'data' => [],
                        'success' => false
                    ];
                }
            }
            $args['file_name'] = !empty($data['file_name']) ? $data['file_name'] :  $data['file']->getClientOriginalName();
            $args['file_name'] = date('YmdHis') . '_' . str_replace(" ", "_", $args['file_name']);
            $args['size'] = str_replace(" ", "_", $data['file']->getSize());
            $args['ext'] = str_replace(" ", "_", $data['file']->getClientOriginalExtension());
            if ($args['size'] > 1024 * 1024 * 10) {
                return [
                    'status' => 200,
                    'message' => 'Dung lượng file không được lớn hơn 10MB',
                    'data' => $args,
                    'success' => false
                ];
            }

            $args['path'] = $path . '/' . $args['file_name'];
            if (!empty($data['width']) || !empty($data['height'])) {
                $resize = resizeImage([
                    'image' => $data['file'],
                    'path' => $path,
                    'file_name' => $args['file_name'],
                    'width' => $data['width'] ?? null,
                    'height' => $data['height'] ?? null,
                ]);
                if (!$resize['success']) {
                    return [
                        'status' => 200,
                        'message' => $resize['message'],
                        'data' => [],
                        'success' => false
                    ];
                }
            } else {
                $data['file']->move($path, $args['file_name']);
            }
            //optimize image
            //            try {
            //
            //            }catch (\Exception $e){
            //
            //            }


            return [
                'status' => 200,
                'message' => 'Thành công',
                'data' => $args,
                'success' => true
            ];
        }
        return [
            'status' => 200,
            'message' => 'File không tồn tại',
            'data' => [],
            'success' => false
        ];
    } catch (Exception $e) {
        return [
            'status' => 200,
            'message' => $e->getMessage(),
            'data' => [],
            'success' => false
        ];
    }
}

function removeFile($data = [])
{
    try {
        if (!empty($data['path']) && file_exists(public_path($data['path']))) {
            unlink(public_path($data['path']));
            return [
                'status' => 200,
                'message' => 'Thanh cong',
                'data' => [],
                'success' => true
            ];
        }
        return [
            'status' => 200,
            'message' => 'File is not exist',
            'data' => [],
            'success' => false
        ];
    } catch (Exception $e) {
        return [
            'status' => 200,
            'message' => $e->getMessage(),
            'data' => [],
            'success' => false
        ];
    }
}

function validateImage($image, $max_size = 5)
{ // MB
    $max_size = $max_size * 1024 * 1024;
    $origin_name = $image->getClientOriginalName();
    $file_size = $image->getSize();
    $ext_file = $image->getClientOriginalExtension();

    $accept_ext = ['jpg', 'png', 'jpeg'];
    if (!in_array($ext_file, $accept_ext)) {
        return [
            'success' => false,
            'message' => 'File không hợp lệ. Vui lòng chọn file ảnh.'
        ];
    }

    if ($file_size > $max_size) {
        return [
            'success' => false,
            'message' => 'Vui lòng chọn hình có dung lượng thấp hơn ' . $max_size . ' MB'
        ];
    }
    return [
        'success' => true,
        'message' => ''
    ];
}

function resizeImage($data)
{
    try {
        if (!empty($data['image'])) {
            $file_name = !empty($data['file_name']) ? $data['file_name'] :  date('YmdHis') . '_' . $data['file']->getClientOriginalName();
            $file_name = str_replace(" ", "_", $file_name);
            $image = Image::make($data['image']);
            $width = $data['width'] ?? $image->width();
            $height = $data['height']  ?? $image->height();
            $path = isset($data['path']) ? $data['path'] : '/resize/' . $width . 'x' . $height;
            if (!is_dir(public_path($path))) {
                mkdir(public_path($path), 0777, true);
            }
            $image->fit($width, $height)->save($path . '/' . $file_name);
            return [
                'success' => true,
                'message' => '',
                'data' => [
                    'path' => $path . '/' . $file_name
                ]
            ];
        }
        return [
            'success' => false,
            'data' => [],
            'message' => 'file không tồn tại',
        ];
    } catch (\Exception $e) {
        return [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }
}
/**
 * @param $file
 * @return boolean
 */
function isUploadFile($file): bool
{
    return $file instanceof UploadedFile;
}

/**
 * @param string $channel
 * @param string $message
 * @param string $level
 * @param array $context
 * @return void
 */
function writeLog(string $channel = 'stack', string $message, string $level = LOG_LEVEL_INFO, $context = []): void
{
    $log = Log::channel($channel);
    $message = 'Log message: ' . $message;
    switch ($level) {
        case LOG_LEVEL_INFO:
            $log->info($message, $context);
            break;
        case LOG_LEVEL_ERROR:
            $log->error($message, $context);
            break;
        case LOG_LEVEL_DEBUG:
            $log->debug($message, $context);
            break;
    }
}

/**
 * @param string $dirty
 * @param array|null $config
 * @return string
 */
function cleanHTML(string $dirty, $config = null): string
{
    return app('purifier')->clean($dirty, $config);
}

/**
 * @param string $imagePath
 * @return string
 */
function renderImagePath(string $imagePath): string
{
    return public_path($imagePath);
}

/**
 * @param string $column
 * @param string $sortKey
 * @param string $sortValue
 * @return string
 */
function showClassSort(string $column, string $sortKey, string $sortValue): string
{
    if ($sortKey == $column) {
        return $sortValue == 0 ? 'fa-sort-down' : 'fa-sort-up';
    }
    return 'fa-sort';
}

/**
 * @param int $status
 * @return string
 */
function showClassStatus(int $status): string
{
    switch ($status) {
        case 0:
            return 'bg-danger';
        case 1:
            return 'bg-success';
        default:
            return '';
    }
}
