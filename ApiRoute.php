<?php

require_once 'libs/Router.php';
require_once 'controllers/ApiClientController.php';
require_once 'controllers/ApiAccountController.php';



$router = new Router();


$router->addRoute('clients', 'GET', 'ClientApiController', 'getClients');
$router->addRoute('clients/:ID', 'GET', 'ClientApiController', 'getClient');
$router->addRoute('clients/:ORDER/:COLUMN', 'GET', 'ClientApiController', 'getByOrderedColumn');
$router->addRoute('clients/:ID', 'DELETE', 'ClientApiController', 'deleteClient');
$router->addRoute('clients', 'POST', 'ClientApiController', 'insertClient');
$router->addRoute('clients/:ID', 'PUT', 'ClientApiController', 'updateClient');
$router->addRoute('accounts', 'GET', 'AccountApiController', 'getAccounts');
$router->addRoute('accounts/:ID', 'GET', 'AccountApiController', 'getAccount');
$router->addRoute("accounts/clients/:ID", "GET", "AccountApiController", "getAllAccountsbyClient");
$router->addRoute('accounts/:ORDER/:COLUMN', 'GET', 'AccountApiController', 'getByOrderedColumn');
$router->addRoute('accounts/:ID', 'DELETE', 'AccountApiController', 'deleteAccount');
$router->addRoute('accounts', 'POST', 'AccountApiController', 'insertAccount');
$router->addRoute('accounts/:ID', 'PUT', 'AccountApiController', 'updateAccount');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);