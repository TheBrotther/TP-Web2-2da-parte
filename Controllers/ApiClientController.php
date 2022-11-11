<?php


require_once "Models/clientModel.php";
require_once "Views/ApiView.php";


class ApiClientController {
    private $model;
    private $view;
    private $data;

    
    public function __construct(){
        $this->model = new ClientModel;
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }


    public function getClients(){
        $clients = $this->model->getAllItems("client");
        if ($clients)
            $this->view->response($clients);
        else
            $this->view->response("Vacio", 204);
        
    }

    public function getClient($params = null){
        $id = $params[':ID'];
        $client = $this->model->getClientById($id);
        if ($client)
           $this->view->response($client);
        else
            $this->view->response("El cliente no existe", 404);
    }

    






}