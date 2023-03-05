<?php

beforeEach(function () {
    $this->xApiKey = $_ENV['X_API_KEY'];
    $this->refreshToken = $_ENV['REFRESH_TOKEN'];
});

it('Autenticación en cobru api', function () {
    $cobruSdk = new \CobruSdk\CobruSdk($this->xApiKey, $this->refreshToken);

    $cobruSdk->auth();

    expect($cobruSdk->getAccessToken() != null)->toBeTrue();
});

it('creando link cobru, buscar detalles de pago, pagar un cobru', function () {
    $cobruSdk = new \CobruSdk\CobruSdk($this->xApiKey, $this->refreshToken);

    $request = new \CobruSdk\CobruRequest();
    $request->amount = 10000;
    $request->description = 'test';
    $request->expirationDays = 10;
    $request->paymentMethodEnabled = \CobruSdk\PaymentMethod::toArray();
    $request->callback = 'CALLBACK';
    $request->payerRedirectUrl = 'TEST';

    $cobruSdk->auth();

    $cobru = $cobruSdk->createCobru($request);

    $httpClient = new \CobruSdk\HttpClient\HttpClient();

    $response = $httpClient->get($cobru->getUrlCheckout());

    expect($response->getStatusCode())->toEqual(200);



    /**
     * datalle
     */

    $cobruDetail = $cobruSdk->cobruDetail($cobru->url);

    expect($cobru->getUrlCheckout())->toEqual($cobruDetail->getUrlCheckout());

    /**
     * pagar
     */

    $payment = new \CobruSdk\Payment();

    $payment->name = 'Juan Perez';
    $payment->payment = 'credit_card';
    $payment->cc = '1140867070';
    $payment->email = 'juan@cobru.co';
    $payment->documentType = 'CC';
    $payment->phone = '300000000';
    $payment->creditCard = '4111111111111111';
    $payment->expirationDate = '12/20';
    $payment->cvv = '123';
    $payment->dues = 1;
    $payment->url = $cobru->url;

   $payCobru = $cobruSdk->payCobru($payment);

   expect($payCobru->amount)->toEqual($request->amount);

});

it('Validacion clase PaymentMethod', function () {

    expect(
        CobruSdk\PaymentMethod::validatePaymentMethod(
            [
            CobruSdk\PaymentMethod::COBRU,
            'Daviplata'
           ]
        ))->toBeFalse();

    expect(
        CobruSdk\PaymentMethod::validatePaymentMethod(
            [
                CobruSdk\PaymentMethod::COBRU,
                CobruSdk\PaymentMethod::NEQUI
            ]
        ))->toBeTrue();

    $paymentMethod =  CobruSdk\PaymentMethod::new([
        CobruSdk\PaymentMethod::COBRU,
        CobruSdk\PaymentMethod::NEQUI
    ]);


    expect(in_array(true, array_values($paymentMethod->booleanAssoc())))->toBeTrue();

    expect(in_array(false, array_values($paymentMethod->booleanAssoc())))->toBeTrue();
});

it('verificación ip', function () {
    $cobruSdk = new \CobruSdk\CobruSdk($this->xApiKey, $this->refreshToken);


    expect($cobruSdk->isCobru(\CobruSdk\CobruSdk::PRODUCTION_IP))->toBeTrue();

    expect($cobruSdk->isCobru('192.0.0.2'))->toBeFalse();
});