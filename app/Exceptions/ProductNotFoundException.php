<?php

namespace App\Exceptions;

use Exception;

class ProductNotFoundException extends Exception
{
    protected $productId;
    
    public function __construct($productId)
    {
        $this->productId = $productId;
        $this->message = "The product with the ID {$productId} could not be found.";
    }

    public function getProductId()
    {
        return $this->productId;
    }
}
