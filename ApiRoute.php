<?php

require_once 'Libs/Router.php';
require_once 'Controllers/ApiClientController.php';
require_once 'Controllers/ApiAccountController.php';



$router = new Router();

$router->addRoute('clients', 'GET', 'ApiClientController', 'getClients');
$router->addRoute('client/:ID', 'GET', 'ApiClientController', 'getClient');
$router->addRoute('client/:ID', 'DELETE', 'ApiClientController', 'deleteClient');
$router->addRoute('client', 'POST', 'TaskApiController', 'insertClient');
$router->addRoute('accounts', 'GET', 'ApiAccountController', 'getAccounts');
$router->addRoute('account/:ID', 'GET', 'ApiAccountController', 'getAcount');



$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);