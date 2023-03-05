<?php

namespace CobruSdk\Exception;

class HttpException extends \Exception
{
    public function __construct($code, $message)
    {
        parent::__construct($message, $code);
    }

}