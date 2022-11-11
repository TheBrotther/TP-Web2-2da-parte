<?php


require_once "models/AccountModel.php";
require_once "views/ApiView.php";


class AccountApiController {
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


    public function deleteAccount($params = null) {
        $id = $params[':ID'];

        $account = $this->model->getAccountById($id);
        if ($account) {
            $this->model->deleteAccount($id);
            $this->view->response($account);
        } else 
            $this->view->response("La tarea con el id = $id no existe", 404);
    }

    public function insertAccount($params = null) {
        $account = $this->getData();

        if (empty($account->id_client) || empty($account->amount) || empty($account->alias) || empty($account->city)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertAccount($account->id_client,$account->dni, $account->alias, $account->city);
            $account = $this->model->getAccountById($id);
            $this->view->response($account, 201);
        }
    }












}
