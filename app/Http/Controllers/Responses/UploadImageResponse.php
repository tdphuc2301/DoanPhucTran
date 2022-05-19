<?php 
namespace App\Http\Responses;

class UploadImageResponse{
    private string $response_code;
    private string $message;
    private array $data;

    public function __construct(string $response_code, string $message = '', array $data = [])
    {
        $this->response_code = $response_code;
        $this->message = $message;
        $this->data = $data;
    }

    public function isSuccess(): bool{
        return $this->response_code == config('upload.response_code.success');
    }

    public function getMessage(): string{
        return !empty($this->message) ? $this->message : config("upload.response_message.$this->response_code");
    }

    public function getData(): array{
        return $this->data;
    }
}