<?php
header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 1000');
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
    
    $returnData = $usuarios->obtenerRebajaSemana($data->SEMANA_REBAJA);
    echo json_encode($returnData);
?>