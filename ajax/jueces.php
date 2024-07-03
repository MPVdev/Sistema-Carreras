<?php
session_start();
require "../modelos/jueces.php";
$juez = new jueces();

switch ( $_GET[ "op" ] ) {
  case "logeo":
    $cifrado = hash( 'sha256', $_POST[ "clave" ] );
    $respuesta = $juez->validar( $_POST[ "usuario" ], $cifrado );
    $fila = $respuesta->fetch_row();
    $_SESSION[ "rol" ] = $fila[ 0 ];
    $_SESSION[ "nombre" ] = $fila[ 1 ];
    $_SESSION[ "apellido" ] = $fila[ 2 ];
    $_SESSION[ "cedula" ] = $fila[ 3 ];
    echo $fila[ 0 ];
    break;
  case "MisPuntos":
    $respuestaMisPuntos = $juez->MisPuntos( $_SESSION[ "cedula" ] );
    if ( $respuestaMisPuntos->num_rows > 0 ) {
      while ( $filaMisPuntos = $respuestaMisPuntos->fetch_row() ) {
        $respuestaParticipantes = $juez->Participantes( $filaMisPuntos[ 5 ] );
        if ( $respuestaParticipantes->num_rows > 0 ) {
          $Participantes = "";
          while ( $filaParticipantes = $respuestaParticipantes->fetch_row() ) {
            $Participantes .= "<button onClick='MarcarPunto($filaParticipantes[0],$filaParticipantes[1])' class='glow-on-hover'>$filaParticipantes[2]</button>";
          }
        }
        $listas .= "<details><summary>$filaMisPuntos[2] $filaMisPuntos[3] a las $filaMisPuntos[4], distancia: $filaMisPuntos[1] metros</summary>$Participantes</details>";
      }
    }
    echo json_encode( $listas );
    break;
  case "listar":
    $respuesta = $juez->listar();

    if ( $respuesta->num_rows > 0 ) {
      $datos = array();
      while ( $fila = $respuesta->fetch_row() ) {
        $datos[] = array(
          "Botones" => "<button class='boton-icono glow-on-hover' name='btnEliminar' onClick='eliminar(" . $fila[ 0 ] . ")'><i class='fa-solid fa-trash-can'></i></button><button class='boton-icono glow-on-hover' name='btnEditar' onClick='editar(\"" . $fila[ 0 ] . "*" . $fila[ 1 ] . "*" . $fila[ 2 ] . "*" . $fila[ 3 ] . "\")'><i class='fa-solid fa-pencil'></i></button>",
          "Cedula" => $fila[ 0 ],
          "Nombre" => $fila[ 1 ] . " " . $fila[ 2 ],
          "Usuario" => $fila[ 3 ]
        );
      }
    }
    echo json_encode( array( "data" => $datos ) );
    break;
  case "IngresoJue":
    $cifrado = hash( 'sha256', $_POST[ "clave" ] );
    $respuesta = $juez->ingresoJue( $_POST[ "cedula" ], $_POST[ "nombre" ], $_POST[ "apellido" ], $_POST[ "usuario" ], $cifrado );
    $fila = $respuesta->fetch_row();
    echo $fila[ 0 ];
    break;
  case "EliminarJue":
    $respuesta = $juez->eliminarJue( $_POST[ "cedula" ] );
    $fila = $respuesta->fetch_row();
    echo $fila[ 0 ];
    break;
}
?>