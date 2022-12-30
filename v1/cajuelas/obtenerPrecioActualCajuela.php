<?php
header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 1000');
    require '../../classes/Database.php';
    require '../../classes/AuthMiddleware.php';
    require '../../classes/Cajuela.php';

    $returnData = [];
    $database = new Database();
    $db = $database->dbConnection();

    $cajuela = new Cajuela($db);
    $returnData = $cajuela->obtenerPrecioActualCajuela();

    echo json_encode($returnData);
?>
