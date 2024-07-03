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
    <a href="">Ver Carreras</a>
    <hr>
    <a href="Organizar.php">Organizar Carreras</a>
    <hr>
    <a href="../../ajax/salir.php">Salir</a>
    <hr>
  </div>
  <div class="contenido">
    <button id="btnMostrarCar" class="glow-on-hover">Nuevo</button>
    <div id="formCarDiv" style="display:none;" class="formulario">
      <form id="formCar" name="formCar">
        <h3>Datos Carrera</h3>
        <input type="text" id="idCar" name="idCar" style="display: none">
        <div class="form-group">
          <input type="text" id="NombreCar" name="NombreCar">
          <label class="form-label">Nombre</label>
        </div>
        <div class="form-group">
          <input type="date" id="FechaCar" name="FechaCar" min="">
          <label class="form-label">Fecha</label>
        </div>
        <div class="form-group">
          <input type="time" id="HoraCar" name="HoraCar" required>
          <label class="form-label">Hora Inicio</label>
        </div>
        <h3>Puntos de Control</h3>
        <div class="form-group">
          <input type="text" id="PconNombre" name="PconNombre">
          <label class="form-label">Nombre</label>
        </div>
        <div class="form-group">
          <input type="number" id="PconDistancia" name="PconDistancia" step="10">
          <label class="form-label">Distancia</label>
        </div>
        <ul id="listaPcon">
        </ul>
        <button onClick="AgregarPcon(event)" class="glow-on-hover">Agregar Punto</button>
		  <button type="button" id="eliminarPcon" class="glow-on-hover">Eliminar Punto</button>
        <button class="boton glow-on-hover" type="submit" id="btnEnviarCar" name="btnEnviarCar" style="width: 150px">Crear</button>
        <button class="boton glow-on-hover" type="reset" onClick="limpiar()" style="width: 150px">Limpiar</button>
      </form>
    </div>
    <div id="tblcarreras">
      <table id="VerCarreras" name="VerCarreras">
        <thead>
          <tr>
            <th>Botones</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
            <th>Ganador</th>
            <th>Detalle</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div id="detalles"></div>
    </div>
  </div>
</div>
</body>
<script src="../../files/jquery-3.7.1.min.js"></script>
<script src="../../files/datatables.min.js"></script>
<script src="../js/Carreras.js"></script>
</html>