<?php

namespace CobruSdk\HttpClient;

use CobruSdk\Exception\HttpException;

interface HttpClientInterface
{

    /**
     * @param string $basePathUrl
     * @return HttpClientInterface
     * Configura la url base para las peticiones
     */
    public static function config($basePathUrl);


    /**
     * @param string $basePathUrl
     * @return void
     * asigna una url base
     */
    public function setBasePathUrl($basePathUrl);

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return HttpResponse
     * @throws HttpException
     * petición http con el metodo get
     */
   public  function get($url, $data, $headers);

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return HttpResponse
     * @throws HttpException
     * petición http con el metodo post
     */
   public  function post($url, $data, $headers);
}