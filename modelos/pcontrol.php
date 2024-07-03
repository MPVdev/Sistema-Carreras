<?php
require "../config/conexion.php";
	class PuntoDeControl{
		function Registrar($participante, $pcontrol){
			$sql = "call sp_Registro(1, null, null, $participante, $pcontrol)";
			return ejecutarConsultaSP($sql);
		}
	}
?>