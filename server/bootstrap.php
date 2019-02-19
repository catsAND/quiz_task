<?php

declare (strict_types = 1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

require './vendor/autoload.php';

use function DI\factory;
use DI\ContainerBuilder;
use Api\Provider\Route;
use Symfony\Component\HttpFoundation\Request;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    Request::class => factory(function () {
        $request = Request::createFromGlobals();
        return $request;
    }),
]);
$container = $containerBuilder->build();

$container->get(Route::class); // Init route

return $container;
