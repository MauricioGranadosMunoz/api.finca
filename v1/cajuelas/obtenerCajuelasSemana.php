<?php
header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 1000');
    require '../../classes/Database.php';
    require '../../classes/AuthMiddleware.php';
    require '../../classes/Cajuela.php';

    $allHeaders = getallheaders();
    $database = new Database();
    $db = $database->dbConnection();
    $data = json_decode(file_get_contents("php://input"));

    $cajuela = new Cajuela($db);

    $auth = new Auth($db, $allHeaders );
    
    if($auth->isTokenValid()){
        echo json_encode($cajuela->obtenerCajuelasSemana());
    } else {
        $returnData = $database->endPointResponseMsg(1, false, 'TOKEN DE USUARIO NO VALIDO');
    }
?>
