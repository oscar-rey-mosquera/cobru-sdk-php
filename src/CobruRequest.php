<?php

namespace CobruSdk;

class CobruRequest
{

    /**
     * @var float
     * Monto del cobru, podemos enviar el monto con decimales si así lo deseamos, enviar decimales
     * es opcional por ejemplo: (10000.10) o puede ser enviado sin decimales (10000)
     */
    public $amount;


    /**
     * @var string
     * Descripción del cobru que aparece en las vistas web (Max. 240 caracteres)
     */
    public $description;

    /**
     * @var int
     * Cantidad de dias en los que expira el cobru.
     * Contados apartir del dia de creación. Un cobru expirado ya no puede pagarse (0: el Cobru expira
     * a las 11:59 pm, 1: expira al día siguiente, 2: expira dentro de dos días y así sucesivamente)
     */
    public $expirationDays;

    /**
     * @var array
     * Es un objeto de json convertido a texto.
     * Debe contener la configuracion para los metodos de pago permitidos en el cobru
     */
    public $paymentMethodEnabled;

    /**
     * @var string
     * indica la plataforma desde donde se crea el Cobru debe ser
     * “API” de lo contrario el callback no sera enviado
     */
    public $platform = 'API';

    /**
     * @var string
     * indica la plataforma desde donde se crea el Cobru debe ser
     * “API” de lo contrario el callback no sera enviado
     */
    public $callback;


    /**
     * @var string
     * (opcional) URL para volver al comercio
     */
    public $payerRedirectUrl;

    /**
     * @var ?int
     * El porcentaje de iva cobrado por la venta
     */
    public $iva;

    /**
     * @var ?string
     * Identificador único (opcional)
     */
    public $idempotencyKey;

    /**
     * @var ?string[]
     * (opcional) array con una lista de las imagenes del cobru
     */
    public $images;

    /**
     * @var ?bool
     * para que cobru le cobre el costo del pago al cliente
     */
    public $clientAssumeCosts;

    /**
     * @return array
     */
    public function toArray() {

        $data = [
            'amount' => $this->amount,
            'description' => $this->description,
            'expiration_days' => $this->expirationDays,
            'payment_method_enabled' => json_encode((new PaymentMethod($this->paymentMethodEnabled))->booleanAssoc()),
            'platform' => $this->platform,
            'callback' => $this->callback,
            'payer_redirect_url' => $this->payerRedirectUrl
        ];

        $optionalFields = [
          'iva' => 'iva',
          'images' => 'images',
          'idempotency_key' => 'idempotencyKey',
          'client_assume_costs' => 'clientAssumeCosts'
        ];

        foreach ($optionalFields as $key => $value) {

            if($this->$value) {
                $data = array_merge([$key => $this->$value], $data);
            }
        }


        return $data;


    }

}