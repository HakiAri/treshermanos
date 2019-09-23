<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");

	//echo "<pre>";print_r ($_REQUEST);echo "</pre>";
	$id = trim($_REQUEST["id"]);
	
	$sql = "UPDATE precios set estado=0 where id={$id}";
	var_dump($sql);

	if (!$con->query($sql)) {
		echo "Falló la edicion: (" . $con->errno . ") " . $con->error;
	}
	else{
		echo 1;
	}		
	$con->close();
?>