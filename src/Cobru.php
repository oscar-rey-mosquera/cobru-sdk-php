<?php

namespace CobruSdk;

class Cobru
{
    /**
     * @var int
     * Estado del cobru 0: creado. 1: en proceso. 2: expirado. 3: pagado. 4: devolucion
     */
    public $state;

    /**
     * @var float
     * Monto a pagar en el cobru
     */
    public $amount;

    /**
     * @var float
     * Monto que sera abonado a la cuenta de usuario cuando el cobru sea pagado
     */
    public $payedAmount;

    /**
     * @var float
     * Valor de la comisión cobru
     */
    public $feeAmount;

    /**
     * @var float
     * Valor del IVA sobre la comisión cobru
     */
    public  $ivaAmount;

    /**
     * @var string
     * Descripción del cobru
     */
    public $description;

    /**
     * @var ?string
     */
    public $referenceCobru;

    /**
     * @var string|int
     * Fecha de creación
     */
    public $dateCreated;

    /**
     * @var ?int
     *  Fecha de expiracion del Cobru en formato Epoch
     */
    public $dateExpired;

    /**
     * @var ?string
     * Nombre de quien Pago el cobru
     */
    public $payerName;

    /**
     * @var ?string
     * Numero de documento de quien Pago el cobru
     */
    public $payerId;

    /**
     * @var ?string
     * Email quien Pago el cobru
     */
    public $payerEmail;

    /**
     * @var ?string
     * Telefono de quien Pago el cobru
     */
    public $payerPhone;

    /**
     * @var ?string
     */
    public $paymentMethod;

    /**
     * @var string
     * Código alfanumerico de identificacion del cobru. Con este se accede a la vista web
     * en dev https://dev.cobru.co/{url} y prod https://cobru.me/{url}
     */
    public $url;

    /**
     * @var ?string[]
     * array en formato de texto con una lista de las imagenes del cobru
     */
    public $images;

    /**
     * @var bool
     */
    public $clientAssumeCosts;

    /**
     * @var int
     * Dias para expiración del cobru desde su fecha de creación
     */
    public $expirationDays;

    /**
     * @var string
     * Texto de objeto json con metodos de pago habilitados
     */
    public $paymentMethodEnabled;

    /**
     * @var ?int
     * Id interno del cobru en la plataforma
     */
    public $pk;

    /**
     * @var ?string
     * Numero del dueño cuenta cobru
     */
    public $ownerPhone;

    /**
     * @var ?string
     * Nombre del dueño cuenta cobru
     */
    public $ownerName;

    /**
     * @var ?float
     */
    public $feeIvaAmount;

    /**
     * @var ?string
     * Plataforma donde se creo el cobru
     */
    public $platform;

    /**
     * @var ?string
     * url de notificación de tu aplicación (webhook)
     */
    public $callback;

    /**
     * @var ?float
     * El iva por aplicar a la comisión Cobru
     */
    public $feeIva;

    /**
     * @var ?bool
     */
    public $notSendEmail;

    /**
     * @var ?bool
     */
    public $byTopup;

    /**
     * @var ?string
     * url de redirección del cliente
     */
    public $payerRedirectUrl;

    /**
     * @var ?string
     * id unico
     */
    public $idempotencyKey;


    /**
     * @var string
     * url base del checkout
     */
    public $baseUrlCheckout;

    /**
     * @param int $state
     * @param float $amount
     * @param float $payedAmount
     * @param float $feeAmount
     * @param float $ivaAmount
     * @param string $description
     * @param string|null $referenceCobru
     * @param int|string $dateCreated
     * @param int|null $dateExpired
     * @param string|null $payerName
     * @param string|null $payerId
     * @param string|null $payerEmail
     * @param string|null $payerPhone
     * @param string|null $paymentMethod
     * @param string $url
     * @param string[]|null $images
     * @param bool $clientAssumeCosts
     * @param int $expirationDays
     * @param string $paymentMethodEnabled
     * @param int|null $pk
     * @param string|null $ownerPhone
     * @param string|null $ownerName
     * @param float|null $feeIvaAmount
     * @param string|null $platform
     * @param string|null $callback
     * @param float|null $feeIva
     * @param bool|null $notSendEmail
     * @param bool|null $byTopup
     * @param string|null $payerRedirectUrl
     * @param string|null $idempotencyKey
     * @param string $baseUrlCheckout
     */
    public function __construct(
        int $state,
        float $amount,
        float $payedAmount,
        float $feeAmount,
        float $ivaAmount,
        string $description,
        ?string $referenceCobru,
        $dateCreated,
        ?int $dateExpired,
        ?string $payerName,
        ?string $payerId,
        ?string $payerEmail,
        ?string $payerPhone,
        ?string $paymentMethod,
        string $url,
        ?array $images,
        bool $clientAssumeCosts,
        int $expirationDays,
        string $paymentMethodEnabled,
        ?int $pk,
        ?string $ownerPhone,
        ?string $ownerName,
        ?float $feeIvaAmount,
        ?string $platform,
        ?string $callback,
        ?float $feeIva,
        ?bool $notSendEmail,
        ?bool $byTopup,
        ?string $payerRedirectUrl,
        ?string $idempotencyKey,
        string $baseUrlCheckout
    )
    {
        $this->state = $state;
        $this->amount = $amount;
        $this->payedAmount = $payedAmount;
        $this->feeAmount = $feeAmount;
        $this->ivaAmount = $ivaAmount;
        $this->description = $description;
        $this->referenceCobru = $referenceCobru;
        $this->dateCreated = $dateCreated;
        $this->dateExpired = $dateExpired;
        $this->payerName = $payerName;
        $this->payerId = $payerId;
        $this->payerEmail = $payerEmail;
        $this->payerPhone = $payerPhone;
        $this->paymentMethod = $paymentMethod;
        $this->url = $url;
        $this->images = $images;
        $this->clientAssumeCosts = $clientAssumeCosts;
        $this->expirationDays = $expirationDays;
        $this->paymentMethodEnabled = $paymentMethodEnabled;
        $this->pk = $pk;
        $this->ownerPhone = $ownerPhone;
        $this->ownerName = $ownerName;
        $this->feeIvaAmount = $feeIvaAmount;
        $this->platform = $platform;
        $this->callback = $callback;
        $this->feeIva = $feeIva;
        $this->notSendEmail = $notSendEmail;
        $this->byTopup = $byTopup;
        $this->payerRedirectUrl = $payerRedirectUrl;
        $this->idempotencyKey = $idempotencyKey;
        $this->baseUrlCheckout = $baseUrlCheckout;
    }

    public static function create($data) {

        return new Cobru(
            $data['state'],
            $data['amount'],
            $data['payed_amount'],
            $data['fee_amount'],
            $data['iva_amount'],
            $data['description'],
            $data['reference_cobru'] ?? null,
            $data['date_created'],
            $data['date_expired'] ?? null,
            $data['payer_name'] ?? null,
            $data['payer_id'] ?? null,
            $data['payer_email'] ?? null,
            $data['payer_phone'] ?? null,
            $data['payment_method'] ?? null,
            $data['url'],
            $data['images'] ?? null,
            $data['client_assume_costs'],
            $data['expiration_days'],
            $data['payment_method_enabled'],
            $data['pk'] ?? null,
            $data['owner'] ?? null,
            $data['name'] ?? null,
            $data['fee_iva_amount'] ?? null,
            $data['platform'] ?? null,
            $data['callback'] ?? null,
            $data['fee_iva'] ?? null,
            $data['not_send_email'] ?? null,
            $data['by_topup'] ?? null,
            $data['payer_redirect_url'] ?? null,
            $data['idempotency_key'] ?? null,
            $data['base_url_checkout']
        );
     }


    /**
     * @return string
     * Url del checkout
     */
     public function getUrlCheckout() {
        return $this->baseUrlCheckout . '/' . $this->url;
     }


}