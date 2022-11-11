<?php

require_once 'Libs/Router.php';
require_once 'Controllers/ApiClientController.php';



$router = new Router();

$router->addRoute('clients', 'GET', 'ApiClientController', 'getClients');
$router->addRoute('client/:ID', 'GET', 'ApiClientController', 'getClient');
$router->addRoute('client/:ID', 'DELETE', 'ApiClientController', 'deleteClient');



$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);