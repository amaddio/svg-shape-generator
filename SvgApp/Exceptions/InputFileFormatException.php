<?php

namespace SvgApp\Exceptions;
use Exception;

class InputFileFormatException extends Exception
{
    public function __construct(
            $message = "Input file format is invalid. Please check the input file and try again.",
            $code = 0,
            $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}