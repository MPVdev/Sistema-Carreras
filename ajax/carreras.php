<?php
session_start();
require "../modelos/carreras.php";

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$carrera = new carreras();

switch ( $_GET[ "op" ] ) {
  case "VerCarreras":
    $respuesta = $carrera->listar();

    if ( $respuesta->num_rows > 0 ) {
      $datos = array();
      while ( $fila = $respuesta->fetch_row() ) {
        $datos[] = array(
          "Botones" => "<button name='btnEliminar' onClick='eliminar(" . $fila[ 0 ] . ")' class='boton-icono glow-on-hover'><i class='fa-solid fa-trash-can'></i></button><button name='btnEditar' onClick='editar(\"" . $fila[ 0 ] . "*" . $fila[ 1 ] . "*" . $fila[ 2 ] . "*" . $fila[ 3 ] . "\")'class='boton-icono glow-on-hover'><i class='fa-solid fa-pencil'></i></button>",
          "Nombre" => $fila[ 1 ],
          "Fecha" => $fila[ 2 ],
          "Hora" => $fila[ 3 ],
          "Estado" => $fila[ 4 ],
          "Ganador" => ( isset( $fila[ 5 ] ) ) ? $fila[ 5 ] : "Aun no existe",
          "Detalle" => "<button id='btnDetalle' onClick='Detalle(" . $fila[ 0 ] . ")' class='boton-icono glow-on-hover'><i class='fa-solid fa-circle-info'></i></button>",
        );
      }
      echo json_encode( array( "data" => $datos ) );
    } else {
      echo json_encode( array( "data" => [] ) );
    }
    break;
  case "Detalles":
    $titulos = titulos( $_POST[ "idCarrera" ], $carrera );
    if ( !empty( $titulos ) ) {
      $tabla = "<h2>Detalles de la Carrera</h2><table border='1' class='tbldetalles'><thead><tr>";
      foreach ( $titulos as $titulo => $filas ) {
        $tabla .= "<th>$titulo</th>";
      }
      $tabla .= "</tr></thead><tbody>";
      $maxFilas = max( array_map( 'count', $titulos ) );
      for ( $i = 0; $i < $maxFilas; $i++ ) {
        $tabla .= "<tr>";
        foreach ( $titulos as $filas ) {
          $valor = isset( $filas[ $i ] ) ? $filas[ $i ] : "";
          $tabla .= "<td>$valor</td>";
        }
        $tabla .= "</tr>";
      }
      $tabla .= "</tbody></table>";
      echo json_encode( $tabla );
    } else {
      echo "<p>La Carrera aún no ha sucedido</p>";
    }
    break;
  case "comboCar":
    $respuesta = $carrera->listar();
    if ( $respuesta->num_rows > 0 ) {
      $combo = "";
      while ( $fila = $respuesta->fetch_row() ) {
        $combo .= "<option value='$fila[0]'>$fila[1]" . " dia: " . "$fila[2]</option>";
      }
    }
    echo json_encode( $combo );
    break;
  case "pControl":
    $opciones = jueces( $carrera );
    $respuesta = $carrera->listarpcontrol( $_POST[ 'car' ] );

    if ( $respuesta->num_rows > 0 ) {
      $pcontrol = "";
      while ( $fila = $respuesta->fetch_row() ) {
        $pcontrol .= "<div class='combopcontrol'><label>$fila[1], distancia: $fila[2]</label><select class='pcontrol' id='$fila[0]'>$opciones</select></div>";
      }
    }
    if ( !empty( $pcontrol ) ) {
      echo json_encode( $pcontrol );
    } else {
      echo "no existen puntos de control";
    }

    break;
  case "AgregarCarreras":
    $idCarre = isset( $_POST[ "idCar" ] ) ? $_POST[ "idCar" ] : "null";
    $respuesta = $carrera->ingresoCar( $idCarre, $_POST[ "NombreCar" ], $_POST[ "FechaCar" ], $_POST[ "HoraCar" ] );
    $fila = $respuesta->fetch_row();
    $pcon = $_POST[ "PconAlmacenados" ];
    $carreraeli = ( $idCarre == "null" ) ? $fila[ 1 ] : $idCarre;
    $carrera->eliminarPcon( $carreraeli );
    if ( isset( $fila[ 1 ] ) ) {
      $pcon = json_decode( $pcon, true );
      foreach ( $pcon as $valor ) {
        $respuesta2 = $carrera->insertPcon( $valor[ "nombre" ], $valor[ "distancia" ], $fila[ 1 ] );
      }
    }
    echo $fila[ 0 ];
    break;
  case "EliminarCar":
    $respuesta = $carrera->eliminarCar( $_POST[ "id" ] );
    $fila = $respuesta->fetch_row();
    echo $fila[ 0 ];
    break;
  case "Pcontrol2":
    $respuesta = $carrera->listarpcontrol( $_POST[ 'idCarre' ] );

    if ( $respuesta->num_rows > 0 ) {
      $datos = array();
      while ( $fila = $respuesta->fetch_row() ) {
        $datos[] = array(
          "nombre" => $fila[ 1 ],
          "distancia" => $fila[ 2 ],
        );
      }
    }
    echo json_encode( $datos );
    break;
  case "Organizar":
		echo $_POST["part"];
    break;
}

function titulos( $id, $carrera ) {
  $respuesta = $carrera->obtenerTitulos( $id );
  $titulos = array();

  if ( $respuesta->num_rows > 0 ) {
    while ( $fila = $respuesta->fetch_row() ) {
      $titulo = "$fila[1]<br>" . "$fila[2] metros";
      $filas = filas( $fila[ 0 ], $carrera );
      $titulos[ $titulo ] = $filas;
    }
  }

  return $titulos;
}

function filas( $id, $carrera ) {
  $respuesta = $carrera->Contenido( $id );
  $filas = array();

  if ( $respuesta->num_rows > 0 ) {
    while ( $fila = $respuesta->fetch_row() ) {
      $filas[] = $fila[ 0 ];
    }
  }

  return $filas;
}

function jueces( $carrera ) {
  $respuesta = $carrera->jueces();
  $opciones = "";
  if ( $respuesta->num_rows > 0 ) {
    while ( $fila = $respuesta->fetch_row() ) {
      $opciones .= "<option value='$fila[0]'>$fila[1] $fila[2]</option>";
    }
  }
  return $opciones;
}
?>
