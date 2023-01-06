<?php
class Database {

    private $db_host = '52.152.106.48';
    private $db_name = 'finca';
    private $db_username = 'MauricioGrM';
    private $db_password = '99^Xy7!n1@7%';

    
    public function dbConnection(){
        
        try{
            $conn = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,$this->db_username,$this->db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo json_encode("Todo bien");
            return $conn;
        }
        catch(PDOException $e){
            echo "Error de dbConnection".$e->getMessage(); 
            exit;
        }
          
    }
    public function endPointResponseMsg($success, $status, $message){
        return array_merge([
            'success' => $success,
            'status' => $status,
            'message' => $message
        ]);
    }
}