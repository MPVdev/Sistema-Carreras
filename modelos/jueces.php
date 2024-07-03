<?php
require "../config/conexion.php";
class jueces {
  function validar( $usuario, $clave ) {
    $sql = "call sp_Jueces(0, null, null, null, '$usuario', '$clave');";
    return ejecutarConsultaSP( $sql );
  }

  function MisPuntos( $juez ) {
    $sql = "call sp_Jueces(4, $juez, null, null, null, null);";
    return ejecutarConsultaSP( $sql );
  }

  function Participantes( $carrera ) {
    $sql = "call sp_Jueces(5, $carrera, null, null, null, null)";
    return ejecutarConsultaSP( $sql );
  }

  function listar() {
    $sql = "CALL sp_Jueces(2, null, null, null, null, null)";
    return ejecutarConsultaSP( $sql );
  }

  function ingresoJue( $cedula, $nombre, $apellido, $usuario, $clave ) {
    $sql = "CALL sp_Jueces(1, $cedula, '$nombre', '$apellido', '$usuario', '$clave')";
    return ejecutarConsultaSP( $sql );
  }

  function eliminarJue( $cedula ) {
    $sql = "CALL sp_Jueces(3, $cedula, null, null, null, null)";
    return ejecutarConsultaSP( $sql );
  }
}
?>