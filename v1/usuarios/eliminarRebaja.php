<?php
header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 1000');
    require '../../classes/Database.php';
    require '../../classes/Usuario.php';

    $returnData = [];
    $allHeaders = getallheaders();
    $database = new Database();
    $db = $database->dbConnection();
    $data = json_decode(file_get_contents("php://input"));
    echo json_encode($data);

    $usuarios = new Usuario($db);
    
    if($usuarios->eliminarRebaja($data->REBAJA_ID)){
        $returnData = $database->endPointResponseMsg(1, true, 'CAJUELAS AGREGADAS CON EXITO');
    } else {
        $returnData = $database->endPointResponseMsg(1, false, 'CAJUELAS NO AGREGADAS');
    }
    echo json_encode($returnData);
?>
