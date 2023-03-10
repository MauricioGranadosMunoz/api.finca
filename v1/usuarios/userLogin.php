<?php
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: access");
// header("Access-Control-Allow-Methods: POST");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 1000');

require '../../classes/Database.php';
require '../../classes/JwtHandler.php';

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}

$db_connection = new Database();
$conn = $db_connection->dbConnection();

$data = json_decode(file_get_contents("php://input"));
$returnData = [];

// IF REQUEST METHOD IS NOT EQUAL TO POST
if($_SERVER["REQUEST_METHOD"] != "POST"):
    $returnData = msg(false,404,'Page Not Found!');

// CHECKING EMPTY FIELDS
elseif(!isset($data->EMAIL) 
    || !isset($data->CONTRASENA)
    || empty(trim($data->EMAIL))
    || empty(trim($data->CONTRASENA))
    ):

    $fields = ['fields' => ['EMAIL','CONTRASENA']];
    $returnData = msg(false,422,'Please Fill in all Required Fields!',$fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else:
    $email = trim($data->EMAIL);
    $password = trim($data->CONTRASENA);

    // CHECKING THE EMAIL FORMAT (IF INVALID FORMAT)
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
        $returnData = msg(false,422,'Invalid Email Address!');
    
    // IF PASSWORD IS LESS THAN 8 THE SHOW THE ERROR
    elseif(strlen($password) < 8):
        $returnData = msg(false,422,'Your password must be at least 8 characters long!');

    // THE USER IS ABLE TO PERFORM THE LOGIN ACTION
    else:
        try{
            
            $fetch_user_by_email = "SELECT * FROM `obtener_usuario_login` WHERE `EMAIL`=:EMAIL";
            $query_stmt = $conn->prepare($fetch_user_by_email);
            $query_stmt->bindValue(':EMAIL', $email,PDO::PARAM_STR);
            $query_stmt->execute();

            // IF THE USER IS FOUNDED BY EMAIL
            if($query_stmt->rowCount()):
                $row = $query_stmt->fetch(PDO::FETCH_ASSOC);
                $check_password = password_verify($password, $row['CONTRASENA']);

                // VERIFYING THE PASSWORD (IS CORRECT OR NOT?)
                // IF PASSWORD IS CORRECT THEN SEND THE LOGIN TOKEN
                if($check_password):

                    $jwt = new JwtHandler();
                    $token = $jwt->jwtEncodeData(
                        'http://localhost/php_auth_api/',
                        array("USUARIO_ID"=> $row['USUARIO_ID'])
                    );
                    
                    $sqlQueryLoggedUser = "SELECT * FROM `obtener_usuario_logged` WHere USUARIO_ID = " . $row['USUARIO_ID'];
                    $loggedUser = $conn->query($sqlQueryLoggedUser);
                   
                    $userArray["USUARIO"] = array();
                    foreach ($loggedUser as $user) {
                        $userArray = array(
                            "USUARIO_ID" => $user['USUARIO_ID'],
                            "NOMBRE" => $user['NOMBRE'],
                            "APELLIDOS" => $user['APELLIDOS'],
                            "FECHA_CREACION" => $user['FECHA_CREACION'],
                            "EMAIL" => $user['EMAIL'],
                            "TIPO_USUARIO" => $user['DESCRIPCION'],
                            "TOKEN" => $token
                            
                        );
                    }
                    
                    $returnData = [
                        'success' => true,
                        'message' => 'You have successfully logged in.',
                        'usuario' => $userArray
                    ];

                // IF INVALID PASSWORD
                else:
                    $returnData = msg(false,422,'Invalid Password!');
                endif;

            // IF THE USER IS NOT FOUNDED BY EMAIL THEN SHOW THE FOLLOWING ERROR
            else:
                $returnData = msg(false,422,'Invalid Email Address!');
            endif;
        }
        catch(PDOException $e){
            $returnData = msg(false,500,$e->getMessage());
        }

    endif;

endif;

echo json_encode($returnData);