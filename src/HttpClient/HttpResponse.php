<?php

namespace CobruSdk\HttpClient;

class HttpResponse
{
    /**
     * @var array
     */
     private $body;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @param array $body
     * @param int $statusCode
     */
    public function __construct($statusCode, $body)
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }



}