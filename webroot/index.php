<?php

session_start();

require_once 'settings.php';
require_once 'includes.php';

$controller = 'Index';
$action = 'index';
$parameters = null;

// parsing
if (isset($_GET['route'])) {
    $route = explode('/', $_GET['route']);
    if (isset($route[0])) {
        $action = $route[0];
    }
    if (isset($route[1])) {
        $parameters[0] = $route[1];
    }
    if (isset($route[2])) {
        $parameters[1] = $route[2];
    }
    
}

// set controller's name
if (file_exists(SITE_DIR . DS . 'Controller' . DS . "{$controller}Controller.php")) {
    $controllerName = "\\Controller\\IndexController";
}

// making object, starting actions, catching exeptions
try {
    $controllerObj = new $controllerName;

    if (is_callable(array($controllerObj, $action))) {
        $controllerObj->$action($parameters);
    } else {
        $controllerObj->index();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

