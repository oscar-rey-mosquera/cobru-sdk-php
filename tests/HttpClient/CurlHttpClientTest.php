<?php

$httpClient = \CobruSdk\HttpClient\HttpClient::config('https://jsonplaceholder.typicode.com');

test('Probando me todo get HttpRequest', function () use ($httpClient) {

    $httpResponse = $httpClient->get('/todos/1');

    expect($httpResponse->getStatusCode())->toEqual(200);
});

test('Probando me todo post HttpRequest', function ()  use ($httpClient) {

    $data = [
        'title' => 'test',
        'body' => 'Prueba http post'
    ];

    $httpResponse = $httpClient->post('/posts', $data);

    $response = $httpResponse->getBody();

    expect($httpResponse->getStatusCode())->toEqual(201);
    expect($data['body'])->toEqual($response['body']);
});

