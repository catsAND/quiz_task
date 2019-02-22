<?php

require './vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class QuizTest extends TestCase
{
    private const API_URL = 'https://darkpay.io/quiz/api';
    private $id = '9C3FD9BA34F023EF';

    public function testGetList()
    {
        $client = new Client();
        $response = $client->get(self::API_URL . '/quiz/list');
        $body = json_decode($response->getBody(), true);

        $this->assertEquals('200', $response->getStatusCode());
        $this->assertArrayHasKey('code', $body);
        $this->assertArrayHasKey('data', $body);
        $this->assertEquals('200', $body['code']);
    }

    public function testGetQuestionsAndAnswers()
    {
        $client = new Client();
        $response = $client->get(self::API_URL . '/quiz/' . $this->id . '/list');
        $body = json_decode($response->getBody(), true);

        $this->assertEquals('200', $response->getStatusCode());
        $this->assertArrayHasKey('code', $body);
        $this->assertArrayHasKey('data', $body);
        $this->assertEquals('200', $body['code']);
    }

    public function testStart()
    {
        $client = new Client();
        $response = $client->post(self::API_URL . '/quiz/start', [
            'form_params' => [
                'name' => 'test name',
                'quiz' => '9C3FD9BA34F023EF',
            ]
        ]);
        $body = json_decode($response->getBody(), true);

        $this->assertEquals('200', $response->getStatusCode());
        $this->assertArrayHasKey('code', $body);
        $this->assertArrayHasKey('data', $body);
        $this->assertArrayHasKey('id', $body['data']);
        $this->assertEquals('200', $body['code']);
    }

    public function testResult()
    {
        $client = new Client();
        $response = $client->get(self::API_URL . '/quiz/result/16BE1F022030EC57');
        $body = json_decode($response->getBody(), true);

        $this->assertEquals('200', $response->getStatusCode());
        $this->assertArrayHasKey('code', $body);
        $this->assertArrayHasKey('data', $body);
        $this->assertEquals('200', $body['code']);
        $this->assertEquals('my name!!', $body['data']['name']);
    }
}
