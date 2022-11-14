<?php


require_once "models/ClientModel.php";
require_once "views/ApiView.php";


class ClientApiController {
    private $model;
    private $view;
    private $data;
    private $atributes;

    
    public function __construct(){
        $this->model = new ClientModel;
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
        $this->atributes = array("dni", "alias", "city");
    }

    private function getData() {
        return json_decode($this->data);
    }


    public function getClients(){
        if(isset($_GET['COLUMN'])&& isset($_GET['ORDER'])){
            if($this->sanitized_column($_GET['COLUMN'])) {
                $col = $_GET['COLUMN'];
                if ($_GET['ORDER'] == 'asc'){
                    $clients = $this->model->clientsByOrdenAsc($col);
                    $this->view->response($clients, 200);
                }
                else{
                    if($_GET['ORDER'] == 'desc'){
                    $clients = $this->model->clientsByOrdenDesc($col);
                    $this->view->response($clients, 200);
                    }
                }       
            }
        }
        else{
            $clients = $this->model->getAllItems("client");
            if ($clients)
            $this->view->response($clients,200);
            else
                $this->view->response("El cliente no existe", 404);
        }      
    }

    public function getClient($params = null){
        $id = $params[':ID'];
        $client = $this->model->getClientById($id);
        if ($client)
           $this->view->response($client);
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
                $clients = $this->model->clientsByOrdenAsc($col);
            else
                $clients = $this->model->clientsByOrdenDesc($col);       
        
        }   
        if ($clients)
            $this->view->response($clients, 200);
        else
            $this->view->response('No content', 204);
    }


    public function deleteClient($params = null) {
        $id = $params[':ID'];

        $client = $this->model->getClientById($id);
        if ($client) {
            $this->model->deleteClientById($id);
            $this->view->response($client);
        } else 
            $this->view->response("La tarea con el id = $id no existe", 404);
    }


    public function insertClient($params = null) {
        $client = $this->getData();

        if (empty($client->dni) || empty($client->alias) || empty($client->city)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertClient($client->dni, $client->alias, $client->city);
            $client = $this->model->getClientById($id);
            $this->view->response($client, 201);
        }
    }


    public function updateClient($params = []) {
        $id_client = $params[':ID'];
        $client = $this->model->getClientById($id_client);

        if ($client) {
            $body = $this->getData();
            $dni = $body->dni;
            $alias = $body->alias;
            $city = $body->city;
            $client = $this->model-> updateClient($id_client, $dni, $alias, $city);
            $this->view->response("client id=$id_client actualizada con éxito", 200);
        }
        else 
            $this->view->response("Task id=$id_client not found", 404);
    }





    






}