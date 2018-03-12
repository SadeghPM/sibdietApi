<?php

namespace SadeghPM\Sibdiet\Exception;

class SibdietException extends \Exception
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }
}