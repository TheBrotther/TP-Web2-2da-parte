<?php


require_once "models/AccountModel.php";
require_once "views/ApiView.php";


class AccountApiController {
    private $model;
    private $view;
    private $data;
    private $atributes;

    public function __construct(){
        $this->model = new AccountModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
        $this->atributes = array("id_client", "amount", "type_account", "coin");
        $this->clientModel= new ClientModel();
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

    
    public function getAllAccountsbyClient($params = null) {
        $id = $params[':ID'];

        $accounts = $this->model->getAllAccountsbyClient($id);

        if ($accounts)
            $this->view->response($accounts, 200);
        else
            $this->view->response('No content', 204);

    }    

    public function getAccount($params = null){
        $id = $params[':ID'];
        $account = $this->model->getAccountById($id);
        if ($account)
           $this->view->response($account);
        else
            $this->view->response("El cliente no existe", 404);
    }

    public function sanitized_column($column){
        if (in_array($column, $this->atributes))
            return true;
        else
            return false;
    }


    public function getByOrderedColumn($params = null){
        if($this->sanitized_column($params[':COLUMN'])) {
            $col = $params[':COLUMN'];
            if ($params[':ORDER'] == 'asc')
                $accounts = $this->model->accountsByOrdenAsc($col);
            else
                $accounts = $this->model->accountsByOrdenDesc($col);       
        
        }   
        if ($accounts)
            $this->view->response($accounts, 200);
        else
            $this->view->response('No content', 204);
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

        if (empty($account->id_client) || empty($account->amount) || empty($account->type_account) || empty($account->coin)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertAccount($account->id_client, $account->amount, $account->type_account, $account->coin);
            $account = $this->model->getAccountById($id);
            $this->view->response($account, 201);
        }
    }



    public function updateAccount($params = []) {
        $id_account = $params[':ID'];
        $account = $this->model->getAccountById($id_account);

        if ($account) {
            $body = $this->getData();
            $amount = $body->amount;
            $type_account = $body->type_account;
            $coin = $body->coin;
            $account = $this->model->updateAccount($id_account,$coin, $amount, $type_account);
            $this->view->response("client id=$id_account actualizada con éxito", 200);
        }
        else 
            $this->view->response("Task id=$id_account not found", 404);
    }








}
