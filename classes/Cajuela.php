<?php
    class Cajuela {
        // CONECCION CON LA CLASE DATABASE
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }

        // TABLA GLOBAL
        private $db_table = "Usuario";

    
        // AGREGAR CAJUELAS TRABAJADOR

        public function crearNoticia($CAJUELAS_SEMANA, $NUM_SENAMA, $ADMINISTRADOR_ID ){
            try {
                $sqlObtenerCajuelaSemana = "SELECT * FROM CAJUELAS_SEMANA WHERE NUM_SEMANA =" . date("W");
                $resultTest = $this->conn->query($sqlObtenerCajuelaSemana);
                $query_stmtS = $this->conn->prepare($sqlObtenerCajuelaSemana);
                $query_stmtS->execute();
                $row = $query_stmtS->fetch(PDO::FETCH_ASSOC);

                if ( $row ) {
                    $updateCajuelasQuery = "UPDATE CAJUELAS_SEMANA SET CAJUELAS_JSON_SEMANA = :CAJUELAS_JSON_SEMANA , ADMINISTRADOR_ID = :ADMINISTRADOR_ID WHERE CAJUELAS_SEMANA.CAJUELAS_SEMANA_ID = :CAJUELASEMANAID";
                    $stmt_updateCajuelasQuery = $this->conn->prepare($updateCajuelasQuery);
                    $stmt_updateCajuelasQuery->bindValue(':CAJUELAS_JSON_SEMANA', $CAJUELAS_SEMANA);
                    $stmt_updateCajuelasQuery->bindValue(':ADMINISTRADOR_ID', $ADMINISTRADOR_ID);
                    $stmt_updateCajuelasQuery->bindValue(':CAJUELASEMANAID',  $row['CAJUELAS_SEMANA_ID']);
                    
                    if ($stmt_updateCajuelasQuery->execute()) :
                        return true;
                    else :
                        return false;
                    endif;
                    
                    
                } else {
                    $sqlQuery = "SELECT * FROM obtenertrabajadoresactuales";
                    $result = $this->conn->query($sqlQuery);
                    $stringCajuelasSemana = '[';
            
                    foreach ($result as $row) {
                        $stringCajuelasSemana = $stringCajuelasSemana . '{"lunes":"","martes":"","miercoles":"","jueves":"","viernes":"","sabado":""},';
                    }
                    $stringCajuelasSemana = $stringCajuelasSemana . ']';
                    $fetch_user_by_id = "INSERT INTO `CAJUELAS_SEMANA` (`CAJUELAS_JSON_SEMANA`, `NUM_SEMANA`, `ADMINISTRADOR_ID`) VALUES (:CAJUELAS_JSON_SEMANA, :NUM_SENAMA, :ADMINISTRADOR_ID)";
                    $query_stmt = $this->conn->prepare($fetch_user_by_id);
                    $query_stmt->bindValue(':CAJUELAS_JSON_SEMANA', str_replace(',]',"]",$stringCajuelasSemana), PDO::PARAM_STR);
                    $query_stmt->bindValue(':NUM_SENAMA', date("W"), PDO::PARAM_INT);
                    $query_stmt->bindValue(':ADMINISTRADOR_ID', $ADMINISTRADOR_ID, PDO::PARAM_INT);
                    if ($query_stmt->execute()) :
                        return true;
                    else :
                        return false;
                    endif;
                }
            } catch (PDOException $e) {
                return null;
            }
        }

        public function obtenerCajuelasSemana(){
            try {
                $sqlObtenerCajuelaSemana = "SELECT * FROM CAJUELAS_SEMANA WHERE NUM_SEMANA =" . date("W");
                $resultTest = $this->conn->query($sqlObtenerCajuelaSemana);
                $query_stmtS = $this->conn->prepare($sqlObtenerCajuelaSemana);
                $query_stmtS->execute();
                $row = $query_stmtS->fetch(PDO::FETCH_ASSOC);
                
                if ( $row ) {
                    $sqlObtenerCajuelaSemana = "SELECT * FROM CAJUELAS_SEMANA WHERE NUM_SEMANA =" . date("W");
                    $query_stmtS = $this->conn->prepare($sqlObtenerCajuelaSemana);
                    $query_stmtS->execute();
                    $row = $query_stmtS->fetch(PDO::FETCH_ASSOC);
    
                    if ( $row ) {
                        return  $row;
                    } else {
                       return false;
                    }
                } else {
                    $sqlQuery = "SELECT * FROM obtenertrabajadoresactuales";
                    $result = $this->conn->query($sqlQuery);
                    $stringCajuelasSemana = '[';
            
                    foreach ($result as $row) {
                        $stringCajuelasSemana = $stringCajuelasSemana . '{"lunes":0,"martes":0,"miercoles":0,"jueves":0,"viernes":0,"sabado":0, "total":0},';
                    }
                    $stringCajuelasSemana = $stringCajuelasSemana . ']';
                    $fetch_user_by_id = "INSERT INTO `CAJUELAS_SEMANA` (`CAJUELAS_JSON_SEMANA`, `NUM_SEMANA`, `ADMINISTRADOR_ID`) VALUES (:CAJUELAS_JSON_SEMANA, :NUM_SENAMA, :ADMINISTRADOR_ID)";
                    $query_stmt = $this->conn->prepare($fetch_user_by_id);
                    $query_stmt->bindValue(':CAJUELAS_JSON_SEMANA', str_replace(',]',"]",$stringCajuelasSemana), PDO::PARAM_STR);
                    $query_stmt->bindValue(':NUM_SENAMA', date("W"), PDO::PARAM_INT);
                    $query_stmt->bindValue(':ADMINISTRADOR_ID', 1, PDO::PARAM_INT);
                    if ($query_stmt->execute()) :
                        return true;
                    else :
                        return false;
                    endif;
                }
            } catch (PDOException $e) {
                return null;
            }
        }
    }
?>

