<?php
require_once "global.php";

class Cls_DataConnection {
    function Fn_getConnet(){

        if (!($conexion = new MySQLi(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME))){
            echo "Error de conexión con la base de datos";
            exit();
        }
        return $conexion;
    }
}

if (!function_exists("ejecutarConsultaSP")){
    function ejecutarConsultaSP($sql){
        $Fn = new Cls_DataConnection(); 
        $Cn = $Fn->Fn_getConnet(); 
        $query = $Cn->query($sql);
        if (!$query) {
            echo "Error en la consulta: " . $Cn->error;
        }
        $Cn->close();
        return $query;
    }
}
?>
