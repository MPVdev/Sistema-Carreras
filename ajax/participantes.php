<?php
session_start();
require "../modelos/participantes.php";

$participante = new participantes();

switch ( $_GET[ "op" ] ) {
  case "listar":
    $respuesta = $participante->listar();

    if ( $respuesta->num_rows > 0 ) {
      $datos = array();
      while ( $fila = $respuesta->fetch_row() ) {
        $datos[] = array(
          "Botones" => "<button class='boton-icono glow-on-hover' name='btnEliminar' onClick='eliminar(" . $fila[ 0 ] . ")'><i class='fa-solid fa-trash-can'></i></button><button class='boton-icono glow-on-hover' name='btnEditar' onClick='editar(\"" . $fila[ 0 ] . "*" . $fila[ 1 ] . "*" . $fila[ 2 ] . "*" . $fila[ 3 ] . "*" . $fila[ 4 ] . "\")'><i class='fa-solid fa-pencil'></i></button>",
          "Cedula" => $fila[ 0 ],
          "Nombre" => $fila[ 1 ] . " " . $fila[ 2 ],
          "Telefono" => $fila[ 3 ],
          "Equipo" => $fila[ 4 ]
        );
      }
    }
    echo json_encode( array( "data" => $datos ) );
    break;
  case "IngresoPar":
    $respuesta = $participante->ingresoPar( $_POST[ "cedula" ], $_POST[ "nombre" ], $_POST[ "apellido" ], $_POST[ "telefono" ], $_POST[ "equipo" ] );
    $fila = $respuesta->fetch_row();
    echo $fila[ 0 ];
    break;
  case "EliminarPar":
    $respuesta = $participante->eliminarPar( $_POST[ "cedula" ] );
    $fila = $respuesta->fetch_row();
    echo $fila[ 0 ];
    break;
  case "comboPar":
    $respuesta = $participante->listar();
    if ( $respuesta->num_rows > 0 ) {
      $combo = "";
      while ( $fila = $respuesta->fetch_row() ) {
        $combo .= "<option value='$fila[0]'>$fila[1]" . " " . "$fila[2]</option>";
      }
    }
    echo json_encode( $combo );
    break;
}
?>
