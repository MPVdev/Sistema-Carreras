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
    <h2>Bienvenido, Invitado</h2>
    <div class="icono-logo"><img src="../../files/imagenes/AutoCars Blanco.png" alt="logo AutoCars Blanco" style="width: 150px"></div>
    <a href="home.php">Pagina Principal</a>
    <hr>
    <a href="">Carreras</a>
    <hr>
    <a href="../../ajax/salir.php">Salir</a>
    <hr>
  </div>
  <div class="contenido">
    <table id="VerCarreras" name="VerCarreras">
      <thead>
        <tr>
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
</body>
<script src="../../files/jquery-3.7.1.min.js"></script>
<script src="../../files/datatables.min.js"></script>
<script src="../js/VerCarreras.js"></script>
</html>