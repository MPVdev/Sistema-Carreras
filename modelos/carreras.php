<?php
require( "../config/conexion.php" );
class carreras {
  function listar() {
    $sql = "call sp_Carreras(2, null, null, null, null)";
    return ejecutarConsultaSP( $sql );
  }

  function contenido( $idPcontrol ) {
    $sql = "call sp_Carreras(5, $idPcontrol, null, null, null)";
    return ejecutarConsultaSP( $sql );
  }

  function obtenerTitulos( $carrera ) {
    $sql = "call sp_Carreras(4, $carrera, null, null, null)";
    return ejecutarConsultaSP( $sql );
  }

  function listarpcontrol( $carrera ) {
    $sql = "call sp_Carreras(6, $carrera, null, null, null)";
    return ejecutarConsultaSP( $sql );
  }

  function jueces() {
    $sql = "call sp_Carreras(7, null, null, null, null)";
    return ejecutarConsultaSP( $sql );
  }

  function ingresoCar( $id, $nombre, $fecha, $hora ) {
    $hora = ( strlen( $hora ) == 5 ) ? $hora . ":00": $hora;
    $sql = "CALL sp_Carreras(1, $id, '$nombre', '$fecha','$hora' )";
    return ejecutarConsultaSP( $sql );
  }

  function insertPcon( $nombre, $distancia, $carrera ) {
    $sql = "CALL sp_PControl(1, null, '$nombre', $distancia, null, $carrera)";
    return ejecutarConsultaSP( $sql );
  }

  function eliminarCar( $id ) {
    $sql = "CALL sp_Carreras(3, $id, null, null, null)";
    return ejecutarConsultaSP( $sql );
  }

  function eliminarPcon( $carrera ) {
    $sql = "CALL sp_PControl(4, null, null, null, null, $carrera)";
    ejecutarConsultaSP( $sql );
  }
}
?>