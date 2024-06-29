<?php

namespace SvgApp\Exceptions;
use SvgApp\Exceptions\Throwable;
use Exception;

/**
* Define a custom exception class
*/
class InputFileFormatException extends Exception
{
    public function __construct(
            $message = "Input file format is invalid. Please check the input file and try again.",
            $code = 0,
            Throwable $previous = null
    ) {
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}