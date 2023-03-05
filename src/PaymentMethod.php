<?php

namespace CobruSdk;

use CobruSdk\Exception\CobruInvalidPaymentMethodException;

class PaymentMethod
{
    public const COBRU = 'cobru_phone';
    public const PSE = 'pse';
    public const  BANCOLOMBIA_TRANSFER = 'bancolombia_transfer';
    public  const  CREDIT_CARD = 'credit_card';
    public const NEQUI = 'NEQUI';
    public const EFECTY = 'efecty';
    public const CORRESPONSAL_BANCOLOMBIA = 'corresponsal_bancolombia';
    public const BTC = 'BTC';
    public const CUSD = 'CUSD';
    public const BALOTO = 'baloto';
    public const DALE = 'dale';
    public const BANCOLOMBIA_QR = 'bancolombia_qr';

    /**
     * @var string[]
     */
    private $value;

    /**
     * @param string[] $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string[]
     */
    public function getValue()
    {
        return $this->value;
    }


    /**
     * @param string[] $paymentMethods
     * @return PaymentMethod
     */
    public static function new($paymentMethods){

       if (!static::validatePaymentMethod($paymentMethods)){
           throw new CobruInvalidPaymentMethodException();
       }

       return new PaymentMethod($paymentMethods);
    }


    /**
     * @param string[] $paymentMethods
     * @return bool
     */
    public static function validatePaymentMethod($paymentMethods) {
        $validate = true;

        foreach ($paymentMethods as $paymentMethod) {
            if (!in_array($paymentMethod, self::toArray())) {
                $validate = false;
                break;
            }
        }

        return $validate;
    }

    /**
     * @return array
     * genera un array con los methodos de pago como keys y  booleanos como values
     */
    public function booleanAssoc() {

        $arrayBoolean = [];

        foreach (self::toArray() as $paymentMethod){

            $arrayBoolean[$paymentMethod] = in_array($paymentMethod, $this->getValue());
        }

        return $arrayBoolean;
    }

    public static function toArray() {
        return [
          self::DALE,
          self::BANCOLOMBIA_QR,
          self::BALOTO,
          self::EFECTY,
          self::COBRU,
          self::CREDIT_CARD,
          self::BANCOLOMBIA_TRANSFER,
          self::CORRESPONSAL_BANCOLOMBIA,
          self::NEQUI,
          self::PSE,
          self::BTC,
          self::CUSD
        ];
    }
}