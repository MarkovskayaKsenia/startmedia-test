<?php

use Project\Exceptions\PageNotFoundException;
use Project\View\View;

try {
    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '/../src/' . str_replace('\\', '/', $className) . '.php';
    });


    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/../src/routes.php';

    $isRouteFound = false;

    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }
        if (!$isRouteFound) {
            throw new PageNotFoundException('Страница не найдена!');
        }

        unset($matches[0]);

        $controllerName = $controllerAndAction[0];
        $actionName = $controllerAndAction[1];


        $controller = new $controllerName();
        $controller->$actionName(...$matches);

} catch (PageNotFoundException $e) {
    $view = new View(__DIR__ . '/../templates/errors/');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
} catch (Throwable $e) {
    $view = new View(__DIR__ . '/../templates/errors/');
    $view->renderHtml('error.php', ['error' => $e->getMessage()], 500);
}