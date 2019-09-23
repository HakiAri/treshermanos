<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");

	//echo "<pre>";print_r ($_REQUEST);echo "</pre>";
	$id     = trim($_POST["id_m"]);
	$precio = trim($_POST["precio_m"]);
	$descripcion = trim($_POST["descripcion_m"]);
	//$estado = trim($_POST["estado"]);
	
	#call modificarcurso
	$sql = "UPDATE precios set precio='{$precio}', descripcion='{$descripcion}' where id={$id}";

	//var_dump($sql);exit;

	if (!$con->query($sql)) {
		echo "Falló la edicion: (" . $con->errno . ") " . $con->error;
	}
	else
		echo 1;
		$con->close();
?>