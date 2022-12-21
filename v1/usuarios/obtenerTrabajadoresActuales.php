<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../../classes/Database.php';
    require '../../classes/AuthMiddleware.php';
    require '../../classes/Usuario.php';

    $returnData = [];
    $allHeaders = getallheaders();
    $data = json_decode(file_get_contents("php://input"));
    $database = new Database();
    $db = $database->dbConnection();
    $auth = new Auth($db, $allHeaders );
    $usuarios = new Usuario($db);
    
    if($auth->isTokenValid()){
        $returnData = $usuarios->obtenerTrabajadoresActuales();
    } else {
        $returnData = $database->endPointResponseMsg(1, false, 'TOKEN DE USUARIO NO VALIDO');
    }
    echo json_encode($returnData);
?>