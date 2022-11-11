<?php

require_once "./Models\MainModel.php";


class ClientModel extends Model {
  

    public function __construct() {
        parent::__construct();
        

    }

    public function getClientById($id){
        $query = $this->db->prepare("SELECT* FROM client WHERE client.id_client =?");
        $query->execute([$id]);
        $user= $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }


    public function insertClient($dni, $alias, $city) {
        $query = $this->db->prepare("INSERT INTO client (dni, alias, city) VALUES (?, ?, ?)");
        $query->execute([$dni, $alias, $city]);

        return $this->db->lastInsertId();
    }


    function deleteClientById($id) {
        $query = $this->db->prepare('DELETE FROM client WHERE id_client = ?');
        $query->execute([$id]);
    }

    function updateClient($id_client, $alias, $city){
        $query = $this->db->prepare('UPDATE client SET alias=?, city=?  WHERE id_client = ?');
        $query->execute([$alias,$city,$id_client]);


    }





    




}