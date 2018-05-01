<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 17:20
 */

   $dispatcher = FastRoute\simpleDispatcher(/**
    * @param \FastRoute\RouteCollector $r
    */
     function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/accueil', 'Accueil/index');
    $r->addRoute('GET', '/lechef', 'Lechef/index');
    $r->addRoute('GET', '/contact', 'Contact/index');
    $r->addRoute('POST', '/contact', 'Contact/index');
    $r->addRoute('GET', '/menus', 'Menu/index');
    $r->addRoute('GET', '/partenaires', 'Partenaires/index');
    $r->addRoute('GET', '/mentions', 'Mentions/index');
    $r->addRoute('GET', '/login', 'Login/index');
    $r->addRoute('POST', '/login', 'Login/identifier');
    $r->addRoute('GET', '/login2', 'Login/entree');
    $r->addRoute('GET', '/logout', 'Login/deco');
    $r->addRoute('GET', '/admin/menu', 'AdminMenu/index');
    $r->addRoute('POST', '/admin/ajouter', 'AdminMenu/ajouter');
    $r->addRoute('POST', '/admin/modifier', 'AdminMenu/modifier');
    $r->addRoute('POST', '/admin/modifier/{id: \d+}', 'AdminMenu/afficherModifsMenu');
    $r->addRoute('POST', '/admin/supprimer', 'AdminMenu/supprimer');
    $r->addRoute('GET', '/reservation', 'Calendar/index');
    $r->addRoute('GET', '/reservation/add', 'Calendar/add');
    $r->addRoute('POST', '/reservation/add', 'Calendar/add');
    $r->addRoute('GET', '/reservation/edit', 'Calendar/edit');
    $r->addRoute('POST', '/reservation/edit', 'Calendar/edit');
    $r->addRoute('GET', '/reservation/delete/{id:\d+}', 'Calendar/delete');
    $r->addRoute('GET', '/admin/actu', 'AdminActu/index');
    $r->addRoute('POST', '/admin/actu', 'AdminActu/index');
    $r->addRoute('POST', '/admin/actu/ajouter', 'AdminActu/ajouter');
    $r->addRoute('POST', '/admin/actu/supprimer', 'AdminActu/supprimer');
    $r->addRoute('POST', '/admin/actu/update', 'AdminActu/update');
    $r->addRoute('GET', '/admin/actu/modif', 'AdminActu/afficherActuModif');
    $r->addRoute('POST', '/admin/actu/modif', 'AdminActu/afficherActuModif');
    $r->addRoute('POST', '/admin/actu/modifier', 'AdminActu/modifier');



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
        echo" 404 Not Found";
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
