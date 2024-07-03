<?php
session_start();
if ( $_SESSION[ 'rol' ] != 0 ) {
  header( "Location: ../index.php" );
  exit();
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Carreras</title>
<link rel="stylesheet" href="../../files/estilos.css">
<link href="../../files/datatables.min.css" rel="stylesheet">
<link href="../../files/fontawesome-free-6.5.1/css/fontawesome.css" rel="stylesheet">
<link href="../../files/fontawesome-free-6.5.1/css/brands.css" rel="stylesheet">
<link href="../../files/fontawesome-free-6.5.1/css/solid.css" rel="stylesheet">
</head>

<body>
<div class="contedor">
  <div class="menu-lateral">
    <h2>Bienvenido, <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']?></h2>
    <div class="icono-logo"><img src="../../files/imagenes/AutoCars Blanco.png" alt="logo AutoCars Blanco" style="width: 150px"></div>
    <a href="home.php">Pagina Principal</a>
    <hr>
    <a href="Participantes.php">Ver Participantes</a>
    <hr>
    <a href="Jueces.php">Ver Jueces</a>
    <hr>
    <a href="Carreras.php">Ver Carreras</a>
    <hr>
    <a href="">Organizar Carreras</a>
    <hr>
    <a href="../../ajax/salir.php">Salir</a>
    <hr>
  </div>
  <div class="contenido">
    <div class="carrera">
      <p> Seleccione Carrera:
        <select id="cbbCarreras" name="cbbCarreras">
        </select>
      <div id="pcontrol"></div>
      </p>
    </div>
    <div class="participante">
      <p>Participantes
        <select id="cbbParticipantes">
        </select>
      </p>
      <ul id="ListaParticipantes" class="ListaPar">
      </ul>
      <button id="agregarParticipante" class="glow-on-hover">Agregar Participante</button>
      <button id="eliminarParticipante" class="glow-on-hover">Eliminar Participante</button>
    </div>
    <button id="crearCarrera" name="crearCarrera" class="glow-on-hover">Crear carrera</button>
  </div>
</div>
</body>
<script src="../../files/jquery-3.7.1.min.js"></script>
<script src="../../files/datatables.min.js"></script>
<script src="../js/organizar.js"></script>
</html>