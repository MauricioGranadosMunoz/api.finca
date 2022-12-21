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
    }
?>

