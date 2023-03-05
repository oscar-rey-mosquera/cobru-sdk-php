<?php

namespace CobruSdk\Exception;

use JetBrains\PhpStorm\Pure;

class CobruInvalidPaymentMethodException extends \Exception
{
     public function __construct()
    {
        parent::__construct('Metodo de pago invalido');
    }


}