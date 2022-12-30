<?php
header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 1000');

require '../../classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

function msg($success, $status, $message, $extra = [])
{
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ], $extra);
}

// DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
$returnData = [];

if ($_SERVER["REQUEST_METHOD"] != "POST") :

    $returnData = msg(0, 404, 'Page Not Found!');

elseif (
    !isset($data->NOMBRE)
    || !isset($data->EMAIL)
    || !isset($data->APELLIDOS)
    || !isset($data->CONTRASENA)
    || empty(trim($data->NOMBRE))
    || empty(trim($data->EMAIL))
    || empty(trim($data->APELLIDOS))
    || empty(trim($data->CONTRASENA))
) :

    $fields = ['fields' => ['NOMBRE', 'EMAIL', 'APELLIDOS', 'CONTRASENA']];
    $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else :

    $name = trim($data->NOMBRE);
    $email = trim($data->EMAIL);
    $apellidos = trim($data->APELLIDOS);
    $password = trim($data->CONTRASENA);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
        $returnData = msg(0, 422, 'Invalid Email Address!');

    elseif (strlen($password) < 8) :
        $returnData = msg(0, 422, 'Your password must be at least 8 characters long!');

    elseif (strlen($name) < 3) :
        $returnData = msg(0, 422, 'Your name must be at least 3 characters long!');

    else :
        try {

            $check_email = "SELECT * FROM `obtener_usuario_login` WHERE `EMAIL`=:EMAIL";
            $check_email_stmt = $conn->prepare($check_email);
            $check_email_stmt->bindValue(':EMAIL', $email, PDO::PARAM_STR);
            $check_email_stmt->execute();

            if ($check_email_stmt->rowCount()) :
                $returnData = msg(0, 422, 'This E-mail already in use!');

            else :
                $insert_query = "INSERT INTO USUARIO(NOMBRE, APELLIDOS, TIPO_USUARIO_ID) VALUES(:nombre, :apellidos, :tipo_usuario_id)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                $insert_stmt->bindValue(':nombre', $name, PDO::PARAM_STR);
                $insert_stmt->bindValue(':apellidos', $apellidos, PDO::PARAM_STR);
                $insert_stmt->bindValue(':tipo_usuario_id', 1, PDO::PARAM_INT);

                $insert_stmt->execute();

                $insert_query_q2 = "INSERT INTO ADMINISTRADOR(EMAIL, CONTRASENA, USUARIO_ID ) VALUES(:email, :contrasena, (SELECT USUARIO_ID FROM USUARIO ORDER BY USUARIO_ID DESC LIMIT 1));";

                $insert_stmt_q2 = $conn->prepare($insert_query_q2);

                // DATA BINDING
                $insert_stmt_q2->bindValue(':email', $email, PDO::PARAM_STR);
                $insert_stmt_q2->bindValue(':contrasena', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

                $insert_stmt_q2->execute();

                $returnData = msg(1, 201, 'You have successfully registered.');

            endif;
        } catch (PDOException $e) {
            $returnData = msg(0, 500, $e->getMessage());
        }
    endif;
endif;

echo json_encode($returnData);