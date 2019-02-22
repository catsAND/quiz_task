<?php

namespace Api\Provider;

use function FastRoute\simpleDispatcher;
use FastRoute\{Dispatcher, RouteCollector};
use DI\Container;
use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use Api\Settings;

/**
 * Provider for routing
 */
class Route
{
    /**
     * Initialize route
     *
     * @param Container $cnt      container object
     * @param Request   $request  request object
     * @param Settings  $settings settings object
     */
    public function __construct(Container $cnt, Request $request, Settings $settings)
    {
        $config = $settings->get('route');

        $dispatcher = simpleDispatcher(function (RouteCollector $r) use ($config) {
            $r->addGroup('/api', function (RouteCollector $r) use ($config) {
                foreach ($config as $route) {
                    $r->addRoute($route[0], $route[1], $route[2]);
                }
            });
        });

        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                $response = new JsonResponse(['code' => JsonResponse::HTTP_NOT_FOUND]);
                $response->send();
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                $response = new JsonResponse(['code' => JsonResponse::HTTP_METHOD_NOT_ALLOWED]);
                $response->send();
                break;
            case Dispatcher::FOUND:
                $className = $routeInfo[1][0];
                $methodName = $routeInfo[1][1];
                $class = $cnt->get($className);
                call_user_func(array($class, $methodName), $routeInfo[2]);
                break;
        }
    }
}
