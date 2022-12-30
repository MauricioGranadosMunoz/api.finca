<?php
    class Usuario {
        // CONECCION CON LA CLASE DATABASE
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }

        // TABLA GLOBAL
        private $db_table = "Usuario";

    
        // OBTENER TRABAJADORES
        public function obtenerTrabajadoresActuales(){
        $sqlQuery = "SELECT * FROM obtenertrabajadoresactuales";
        $result = $this->conn->query($sqlQuery);
        $categoriasArr["TRABAJADORES"] = array();

            foreach ($result as $row) {
                $temp = array(
                    "TRABAJADOR_ID" => $row['TRABAJADOR_ID'],
                    "NOMBRE" => $row['NOMBRE'],
                    "APELLIDOS" => $row['APELLIDOS'],
                    "FECHA_CREACION" => $row['FECHA_CREACION'],
                    "TRABAJADOR_ACTUAL" => $row['TRABAJADOR_ACTUAL']
                );
                array_push($categoriasArr["TRABAJADORES"], $temp);
            }
            return $categoriasArr;
        }


        public function agregarRebaja($TRABAJADOR_ID, $MONTO_REBAJA, $DESCRIPCION ){
            try {
                $SQL_AGREGAR_REBAJA = "INSERT INTO REBAJA ( TRABAJADOR_ID, MONTO_REBAJA, SEMANA_REBAJA, DESCRIPCION ) VALUES (:TRABAJADOR_ID, :MONTO_REBAJA, :SEMANA_REBAJA, :DESCRIPCION)";
                $STMT_QUERY_AGREGAR_REBAJA = $this->conn->prepare($SQL_AGREGAR_REBAJA);
                $STMT_QUERY_AGREGAR_REBAJA->bindValue(':TRABAJADOR_ID', $TRABAJADOR_ID, PDO::PARAM_INT);
                $STMT_QUERY_AGREGAR_REBAJA->bindValue(':MONTO_REBAJA', $MONTO_REBAJA, PDO::PARAM_INT);
                $STMT_QUERY_AGREGAR_REBAJA->bindValue(':SEMANA_REBAJA', date("W"), PDO::PARAM_INT);
                $STMT_QUERY_AGREGAR_REBAJA->bindValue(':DESCRIPCION', $DESCRIPCION, PDO::PARAM_STR);
                    
                    if ($STMT_QUERY_AGREGAR_REBAJA->execute()) :
                        return true;
                    else :
                        return false;
                endif;
            } catch (PDOException $e) {
                    return false;
            }
        }

        public function obtenerRebajaSemana($SEMANA_REBAJA){
            $SQL_OBTENER_REBAJA_SEMANA = "SELECT * FROM REBAJA WHERE SEMANA_REBAJA =" . $SEMANA_REBAJA;
            $result = $this->conn->query($SQL_OBTENER_REBAJA_SEMANA);
            
            $categoriasArr["REBAJAS"] = array();
    
                foreach ($result as $row) {
                    $temp = array(
                        "REBAJA_ID" => $row['REBAJA_ID'],
                        "TRABAJADOR_ID" => $row['TRABAJADOR_ID'],
                        "MONTO_REBAJA" => $row['MONTO_REBAJA'],
                        "SEMANA_REBAJA" => $row['SEMANA_REBAJA'],
                        "DESCRIPCION" => $row['DESCRIPCION']
                    );
                    array_push($categoriasArr["REBAJAS"], $temp);
                }
            return $categoriasArr;
        }    

        public function eliminarRebaja($REBAJA_ID){
            try {
                $SQL_AGREGAR_REBAJA = "DELETE FROM REBAJA WHERE REBAJA_ID = :REBAJA_ID";
                $STMT_QUERY_AGREGAR_REBAJA = $this->conn->prepare($SQL_AGREGAR_REBAJA);
                $STMT_QUERY_AGREGAR_REBAJA->bindValue(':REBAJA_ID', $REBAJA_ID, PDO::PARAM_INT);
                    
                    if ($STMT_QUERY_AGREGAR_REBAJA->execute()) :
                        return true;
                    else :
                        return false;
                endif;
            } catch (PDOException $e) {
                    return false;
            }
        }    
    }
?>

