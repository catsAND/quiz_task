<?php

namespace Api\Controller;

use Api\Controller\ControllerAbstract;
use Symfony\Component\HttpFoundation\JsonResponse;

class Ping extends ControllerAbstract
{
    public function execute($vars)
    {
        $response = new JsonResponse(['code' => JsonResponse::HTTP_OK, 'data' => ['pong']]);
        $response->send();
    }
}
