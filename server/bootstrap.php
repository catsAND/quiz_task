<?php

declare (strict_types = 1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

require './vendor/autoload.php';

use function DI\factory;
use DI\ContainerBuilder;
use Api\Provider\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Api\Provider\Doctrine;
use Api\Settings;
use Psr\Container\ContainerInterface;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    Request::class => factory(function () {
        $request = Request::createFromGlobals();
        return $request;
    }),
    EntityManager::class => factory(function (ContainerInterface $c) {
        $class = $c->get(Doctrine::class);
        return $class->getEntityManager();
    }),
]);
$container = $containerBuilder->build();

$container->get(Route::class); // Init route

return $container;
