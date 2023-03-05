<?php

namespace CobruSdk\HttpClient;

use CobruSdk\Exception\HttpException;

class CurlHttpClient implements HttpClientInterface
{

    /**
     * @var array
     */
    private  $defaultConfig = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 3,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HEADER => true,
        CURLOPT_RETURNTRANSFER => true
    ];

    /**
     * @var string[]
     */
    private  $defaultHeaders = [
        'Content-Type: application/json',
    ];

    /**
     * @var string
     */
    private $basePathUrl;

    /**
     * @param string $basePathUrl
     */
    public function setBasePathUrl($basePathUrl)
    {
        $this->basePathUrl = $basePathUrl;
    }

    public function __construct(){}

    private function getHeaders($headers)
    {
        return array_merge($this->defaultHeaders, $headers);
    }

    /**
     * @param string $url
     * @return string
     * @description genera la url completa
     */
    private function getUrl($url)
    {
        if(!$this->basePathUrl) {
            return $url;
        }

        return $this->basePathUrl . $url;
    }

    public static function config($baseUrl) {

        $curlHttClien = new CurlHttpClient();

        $curlHttClien->setBasePathUrl($baseUrl);

        return $curlHttClien;
    }

    private static function execute($curl)
    {
        $response = curl_exec($curl);

        $bodyString = substr($response, curl_getinfo($curl, CURLINFO_HEADER_SIZE));
        $body =  json_decode($bodyString, true);

        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($statusCode < 400) {
            return new HttpResponse($statusCode, $body);
        }

        throw new HttpException(
            $statusCode,
            $bodyString
        );
    }

    public function post($url, $data = [], $headers = [])
    {
        $curl = curl_init();

        $curlOptions = $this->defaultConfig + [
                CURLOPT_URL => $this->getUrl($url),
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => $this->getHeaders($headers)
            ];
        curl_setopt_array($curl, $curlOptions);

        return $this->execute($curl);
    }

    public function get($url, $data = [], $headers = [])
    {
        $curl = curl_init();

        $curlOptions = $this->defaultConfig + [
                CURLOPT_URL => $this->getUrl($url) . '?' . http_build_query($data),
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => $this->getHeaders($headers)
            ];
        curl_setopt_array($curl, $curlOptions);

        return $this->execute($curl);
    }
}