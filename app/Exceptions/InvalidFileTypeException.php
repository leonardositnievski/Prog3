<?php

namespace App\Exceptions;

use Exception;

class InvalidFileTypeException extends Exception
{
    public function __construct($file, $mimes) {
        parent::__construct(__('validation.invalid_midia_type',[
            'file_type' => $file->getClientMimeType(),
            'valid_types' => implode('|',$mimes)
        ]));
    }
}
