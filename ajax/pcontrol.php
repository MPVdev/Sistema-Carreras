<?php
session_start();
require "../modelos/pcontrol.php";
$pcontrol = new PuntoDeControl();

switch ( $_GET[ "op" ] ) {
  case "Registrar":
      $respuesta = $pcontrol->Registrar($_POST["participante"], $_POST["pcontrol"]);
          $fila = $respuesta->fetch_row();
    echo $fila[0];
    break;
}
?>