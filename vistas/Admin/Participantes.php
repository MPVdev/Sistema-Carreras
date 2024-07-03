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
    <h2>Bienvenido, <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?></h2>
    <div class="icono-logo"><img src="../../files/imagenes/AutoCars Blanco.png" alt="logo AutoCars Blanco" style="width: 150px"></div>
    <a href="home.php">Pagina Principal</a>
    <hr>
    <a href="">Ver Participantes</a>
    <hr>
    <a href="Jueces.php">Ver Jueces</a>
    <hr>
    <a href="Carreras.php">Ver Carreras</a>
    <hr>
    <a href="Organizar.php">Organizar Carreras</a>
    <hr>
    <a href="../../ajax/salir.php">Salir</a>
    <hr>
  </div>
  <div class="contenido">
    <button id="btnMostrarPar" class="glow-on-hover">Nuevo</button>
    <div id="formParDiv" style="display:none;" class="formulario">
      <form id="formPar" name="formPar">
        <div class="form-group">
          <input type="text" name="cedula" id="cedula" maxlength="10" oninput="validarNumero(this)">
          <label class="form-label">Cedula</label>
        </div>
        <div class="form-group">
          <input type="text" name="nombre" id="nombre">
          <label class="form-label">Nombre</label>
        </div>
        <div class="form-group">
          <input type="text" name="apellido" id="apellido">
          <label class="form-label">Apellido</label>
        </div>
        <div class="form-group">
          <input type="text" name="telefono" id="telefono" maxlength="10" oninput="validarNumero(this)">
          <label class="form-label">Telefono</label>
        </div>
		  <div class="form-group">
        <input type="text" name="equipo" id="equipo">
        <label class="form-label">Equipo</label>
      </div>
        <button class="boton glow-on-hover" type="submit" id="btnEnviarPar" name="btnEnviarPar" style="width: 150px">Crear</button>
        <button class="boton glow-on-hover" type="reset" onClick="limpiar()" style="width: 150px">Limpiar</button>
      </form>
    </div>
	  <div id="tblparticipantes">
    <table id="participantes" name="articipantes" class="tablas">
      <thead>
        <tr>
          <th>Botones</th>
          <th>Cedula</th>
          <th>Nombre</th>
          <th>Telefono</th>
          <th>Equipo</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
</div>
</body>
<script src="../../files/jquery-3.7.1.min.js"></script>
<script src="../../files/datatables.min.js"></script>
<script src="../js/participantes.js"></script>
</html>
