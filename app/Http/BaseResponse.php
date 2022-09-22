<?php

namespace App\Http;

class BaseResponse
{
    public $errorCode = 0;
    public $message = "";
    public $data = null;

    public static function withData($data)
    {
        $instance = new self();
        $instance->data = $data;
        return (array)$instance;
    }
    public static function success($message)
    {
        $instance = new self();
        $instance->message = $message;
        return (array)$instance;
    }
    public static function error($errorCode, $message)
    {
        $instance = new self();
        $instance->$errorCode = $errorCode;
        $instance->message = $message;
        return (array)$instance;
    }
}
