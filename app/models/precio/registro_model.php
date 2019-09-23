<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	require_once ("../../config/route.php");

	//echo "<pre>";print_r ($_REQUEST);echo "</pre>";
	$precio = trim($_POST["precio"]);
	$descripcion = trim($_POST["descripcion"]);
	$estado = trim("1");
	
	$sql = "INSERT INTO precios(precio,descripcion,estado) VALUES('{$precio}','{$descripcion}','{$estado}')";

	if (!$con->query($sql)) {
		echo "Falló la insercion: (" . $con->errno . ") " . $con->error;
	}
	else
		echo 1;
		$con->close();
?>