<?php

namespace CobruSdk;

use CobruSdk\HttpClient\HttpClient;
use CobruSdk\HttpClient\HttpClientInterface;

class CobruSdk
{

    /**
     * @var string
     * @link https://panel.cobru.co/integracion
     */
    private $xApiKey;


    /**
     * @var string
     * @link https://panel.cobru.co/integracion
     */
    private $refreshToken;

    /**
     * @return bool
     */
    public function isProduction(): bool
    {
        return $this->isProduction;
    }

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var boolean
     */
    private $isProduction;

    /**
     * @var string
     */
    public const PRODUCTION_URL = 'https://prod.cobru.co';

    /**
     * @var string
     */
    public const DEVELOPMENT_URL = 'https://dev.cobru.co';

    /**
     * @var string
     */
    public const CHECKOUT_PRODUCTION_URL = 'https://cobru.me';

    /**
     * @var string
     */
    public const PRODUCTION_IP = '35.183.151.137';

    /**
     * @var string
     */
    public const DEVELOPMENT_IP = '52.60.68.103';

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @var array
     */
    private $headers;

    /**
     * @param string $xApiKey
     * @param string $refreshToken
     * @param bool $isProduction
     */
    public function __construct(string $xApiKey = '', string $refreshToken = '', bool $isProduction = false)
    {
        $this->xApiKey = $xApiKey;
        $this->refreshToken = $refreshToken;
        $this->isProduction = $isProduction;
        $this->headers = [
            'x-api-key: ' . $this->xApiKey
        ];
    }


    /**
     * @return HttpClientInterface
     */
    private function httpClient() {

        return HttpClient::config($this->getCurrentUrl());
    }


    public function getCurrentUrl() {
        return $this->isProduction ? self::PRODUCTION_URL : self::DEVELOPMENT_URL;
    }

    public function getCurrentCobruCheckoutUrl() {
        return $this->isProduction ? self::PRODUCTION_URL : self::CHECKOUT_PRODUCTION_URL;
    }

    public function auth() {

            $response = $this->httpClient()->post('/token/refresh/', [
                'refresh' => $this->refreshToken
            ],
                $this->headers
            )->getBody();

            $this->accessToken = $response['access'];

            return $this;
    }

    /**
     * @param CobruRequest $cobruRequest
     * @return Cobru
     * crear un pagon en cobru
     */
    public function createCobru($cobruRequest) {

        $response = $this->httpClient()->post('/cobru/', $cobruRequest->toArray() , $this->getCobruHeaders())->getBody();

        return Cobru::create($this->mergeNewDataBody($response));

    }

    /**
     * @param string $url
     * @return Cobru
     * obtener los detalles de un cobru
     */
    public function cobruDetail($url) {

        $response = $this->httpClient()->get('/cobru_detail/'.$url, [] , $this->getCobruHeaders())->getBody();

        return Cobru::create($this->mergeNewDataBody($response));
    }

    /**
     * @param Payment $payment
     *
     */
    public function payCobru($payment){

        $response = $this->httpClient()->post('/'. $payment->url, $payment->toArray() , $this->getCobruHeaders())->getBody();

        $response = json_decode($response, true);

        return Cobru::create($this->mergeNewDataBody($response[1]['fields']));
    }

    private function getCobruHeaders() {

        return array_merge($this->headers, ['Authorization: Bearer '.$this->accessToken]);
    }
    private function mergeNewDataBody($data) {
        return array_merge($data, ['base_url_checkout' => $this->getCurrentCobruCheckoutUrl()]);
    }

    /**
     * @param string $ip
     * @return bool
     * verifica la identidad de cobru
     */
    public function isCobru($ip) {
      return in_array($ip, [ self::PRODUCTION_IP, self::DEVELOPMENT_IP]);
    }





}