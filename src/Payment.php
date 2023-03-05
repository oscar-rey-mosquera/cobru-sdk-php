<?php

namespace CobruSdk;

class Payment
{

    /**
     * @var string
     * Nombre de quien paga el cobru
     */
   public $name;


    /**
     * @var string
     * 	Metodo de pago puede ser “efecty”, “bancolombia_transfer”, “dale” y “corresponsal_bancolombia”
     */
   public $payment;


    /**
     * @var string
     * Código alfanumerico de identificacion del cobru.
     */
    public $url;


    /**
     * @var string
     * 	Numero del documento de quien paga el cobru
     */
    public $cc;


    /**
     * @var string
     * tipo de documento de quien paga el cobru. Puede ser: CC TI CE PA
     */
    public $documentType;

    /**
     * @var string
     * Numero de telefono de quien paga el cobru
     */
    public $phone;

    /**
     * @var ?string
     * Numero de telefono nequi de quien paga el cobru
     */
    public $phoneNequi;

    /**
     * @var string
     *  email de quien paga el cobru
     */
    public $email;


    /**
     * @var ?boolean
     *  “push”:false no se enviara un push, pero en esta respuesta trae la información para generar QR, el qr se encuentra en la variable “ref”: “bancadigital-C001-22200-hjsdfjksfgjsfgsd”
     */
    public $push;


    /**
     * @var ?string
     * Código del Banco desde el cual se realizara el pago. Leer mas abajo para obtener la lista de bancos.
     */
    public $bank;

    /**
     * @var ?string
     * Dirección de quien paga el cobru
     */
    public $address;


    /**
     * @var ?string
     * numero de la tarjeta de credito sin espacios
     */
    public $creditCard;


    /**
     * @var ?string
     * 	fecha de expiración en el formato MM/AA
     */
    public $expirationDate;


    /**
     * @var ?string
     * 	código cvv
     */
    public $cvv;


    /**
     * @var ?int
     * numero de cuotas
     */
    public $dues;


    public function toArray() {

        $paymentArray = [
          'name' => $this->name,
          'payment' => $this->payment,
          'url' => $this->url,
            'cc' => $this->cc,
            'document_type' => $this->documentType,
            'phone' => $this->phone,
            'email' => $this->email
        ];

        $optionalFields = [
            'phone_nequi' => 'phoneNequi',
            'bank' => 'bank',
            'push' => 'push',
            'address' => 'address',
            'credit_card' => 'creditCard',
            'expiration_date' => 'expirationDate',
            'cvv' => 'cvv',
            'dues' => 'dues'
        ];

        foreach ($optionalFields as $key => $value) {

            if(!is_null($this->$value)) {

                $paymentArray = array_merge($paymentArray, [ $key => $this->$value]);
            }

        }


        return $paymentArray;
    }


}