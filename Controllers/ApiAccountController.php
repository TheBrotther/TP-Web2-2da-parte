<?php


require_once "Models/AccountModel.php";
require_once "Views/ApiView.php";


class ApiAccountController {
    private $model;
    private $view;
    private $data;


    public function __construct(){
        $this->model = new AccountModel;
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getAccounts(){
        $accounts = $this->model->getAllItems("account");
        if ($accounts)
            $this->view->response($accounts);
        else
            $this->view->response("Vacio", 204);
        
    }

    public function getAccount($params = null){
        $id = $params[':ID'];
        $account = $this->model->getAccountById($id);
        if ($account)
           $this->view->response($account);
        else
            $this->view->response("El cliente no existe", 404);
    }












}
