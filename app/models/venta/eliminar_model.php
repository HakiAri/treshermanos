<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");

	//echo "<pre>";print_r ($_REQUEST);echo "</pre>";
	$id = trim($_REQUEST["id_eliminar"]);

	//$sql = "UPDATE estudiante set estado=0 where id_rude={$id}";
	$sql = "DELETE FROM ventas WHERE id_venta = {$id}";
	//var_dump($sql); exit;

	if (!$con->query($sql)) {
		echo "Falló la edicion: (" . $con->errno . ") " . $con->error;
	}
	else
		echo 1;
		$con->close();
?>