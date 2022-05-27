<?php

namespace App\Exceptions;

use Exception;

class UploadImageException extends Exception
{
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        writeLog('log_upload_image', $this->getMessage());
    }
}
