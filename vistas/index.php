<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Carrera</title>
<link href="../files/estilos.css" rel="stylesheet">
<link href="../files/fontawesome-free-6.5.1/css/fontawesome.css" rel="stylesheet">
<link href="../files/fontawesome-free-6.5.1/css/brands.css" rel="stylesheet">
<link href="../files/fontawesome-free-6.5.1/css/solid.css" rel="stylesheet">
</head>

<body class="Logeo-body">
<div class="contedor2">
  <div class="centered-content">
    <h3>INGRESO AL SISTEMA</h3>
	  <img src="../files/imagenes/AutoCars.png" class="icono" alt="icono del sistema AutoCars">
    <form id="formlogeo" name="formlogeo">
      <div class="form-group">
        <input type="text" id="usuario" name="usuario" placeholder="Usuario" required>
        <label class="form-label">Usuario</label>
      </div>
      <div class="form-group">
        <input type="password" id="clave" name="clave" placeholder="Clave" required>
        <label class="form-label">Clave</label>
      </div>
      <button name="btningresar" type="submit" class="glow-on-hover">Entrar</button>
    </form>
    <a href="Invitado/home.php">
    <button name="btninvitado" class="glow-on-hover">Invitado</button>
    </a> </div>
</div>
</body>
<script src="../files/jquery-3.7.1.min.js"></script>
<script src="js/logeo.js"></script>
</html>
