<?php

require_once 'Libs/Router.php';
require_once 'Controllers/ApiClientController.php';
require_once 'Controllers/ApiAccountController.php';



$router = new Router();

$router->addRoute('clients', 'GET', 'ClientApiController', 'getClients');
$router->addRoute('client/:ID', 'GET', 'ClientApiController', 'getClient');
$router->addRoute('client/:ID', 'DELETE', 'ClientApiController', 'deleteClient');
$router->addRoute('client', 'POST', 'ClientApiController', 'insertClient');
$router->addRoute('accounts', 'GET', 'AccountApiController', 'getAccounts');
$router->addRoute('account/:ID', 'GET', 'AccountApiController', 'getAccount');
$router->addRoute('account/:ID', 'DELETE', 'AccountApiController', 'deleteAccount');
$router->addRoute('account', 'POST', 'AccountApiController', 'insertAccount');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);