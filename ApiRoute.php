<?php

require_once 'Libs/Router.php';
require_once 'Controllers/ApiClientController.php';



$router = new Router();

$router->addRoute('clients', 'GET', 'ApiClientController', 'getClients');



$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);