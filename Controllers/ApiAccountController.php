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
        $this->atributes = array("id_client", "amount", "type_account", "coin");
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












}
