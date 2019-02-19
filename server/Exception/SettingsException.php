<?php

namespace Api\Exception;

use Exception;

class SettingsException extends Exception
{
    public function __construct($name, $code = 0, Exception $previous = null)
    {
        $message = 'Settings with name `' . $name . '` not found';
        parent::__construct($message, $code, $previous);
    }
}
