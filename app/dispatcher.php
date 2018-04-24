<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 17:20
 */


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/accueil', 'Accueil/index');
    $r->addRoute('GET', '/lechef', 'Lechef/index');
    $r->addRoute('GET', '/contact', 'Contact/index');
    $r->addRoute('POST', '/contact', 'Contact/index');
    $r->addRoute('GET', '/menus', 'Menu/index');
    $r->addRoute('GET', '/partenaires', 'Partenaires/index');
    $r->addRoute('GET', '/login', 'Login/index');
    $r->addRoute('POST', '/login', 'Login/identifier');
    $r->addRoute('GET', '/login2', 'Login/entree');
    $r->addRoute('GET', '/logout', 'Login/deco');
    $r->addRoute('GET', '/admin', 'AdminMenu/index');
    $r->addRoute('POST', '/admin/ajouter', 'AdminMenu/ajouter');
    $r->addRoute('POST', '/admin/supprimer', 'AdminMenu/supprimer');

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode("/", $handler, 2);
        $class = APP_CONTROLLER_NAMESPACE . $class . APP_CONTROLLER_SUFFIX;
        echo call_user_func_array(array(new $class, $method), $vars);
        break;
}
