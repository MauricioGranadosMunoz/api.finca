<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../../classes/Database.php';
    require '../../classes/AuthMiddleware.php';
    require '../../classes/Cajuela.php';

    $returnData = [];
    $allHeaders = getallheaders();
    $database = new Database();
    $db = $database->dbConnection();
    $data = json_decode(file_get_contents("php://input"));

    $auth = new Auth($db, $allHeaders );
    
    if($auth->isTokenValid()){
        $returnData = $database->endPointResponseMsg(1, true, 'TOKEN VALIDO');
    } else {
        $returnData = $database->endPointResponseMsg(1, false, 'TOKEN NO VALIDO');
    }
    echo json_encode($returnData);
?>
