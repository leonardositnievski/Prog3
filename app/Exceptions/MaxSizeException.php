<?php

namespace App\Exceptions;

use App\Helpers\Helpers;
use Exception;

class MaxSizeException extends Exception
{
    public function __construct($file, $max_file_size) {
        parent::__construct(
            __('validation.max_midia_size',
            [
                'file_size' => Helpers::to_KB($file->getSize()),
                'size'      => $max_file_size,
            ]));
    }
}
