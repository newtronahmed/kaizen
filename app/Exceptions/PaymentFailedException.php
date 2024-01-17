<?php

namespace App\Exceptions;

use Exception;
class PaymentFailedException extends Exception {
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
        parent::__construct($message);
    }
}