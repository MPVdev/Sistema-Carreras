<?php
require( "../config/conexion.php" );

class participantes {
  function listar() {
    $sql = "CALL sp_Participantes(2, null, null, null, null, null)";
    return ejecutarConsultaSP( $sql );
  }

  function ingresoPar( $cedula, $nombre, $apellido, $telefono, $equipo ) {
    $sql = "CALL sp_Participantes(1, $cedula, '$nombre', '$apellido', '$telefono', '$equipo')";
    return ejecutarConsultaSP( $sql );
  }

  function eliminarPar( $cedula ) {
    $sql = "CALL sp_Participantes(3, $cedula, null, null, null, null)";
    return ejecutarConsultaSP( $sql );
  }
}
?>
