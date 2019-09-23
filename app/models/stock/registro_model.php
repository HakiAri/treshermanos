<?php 
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	require_once ("../../config/route.php");

	//echo "<pre>";print_r ($_REQUEST);echo "</pre>";
	$descripcion   = trim($_POST["descripcion"]);
	$cantidad   = trim($_POST["cantidad"]);
	$fecha = date("Y-m-d");
	$hora  = date("H:i:s");
	
	$sql = "INSERT INTO `stocks` (`descripcion`, `cantidad`, `vendido`, `fecha_inicio`, `fecha_fin`, `hora_inicio`, `hora_fin`, `usuario_id`, `estado`, `sinc_estado`)
			VALUES ('{$descripcion}', '{$cantidad}', '0', '{$fecha}', '0000-00-00', '12:34:48', '00:00:00', '2', '1', '2');";
	//var_dump($sql);
	if (!$con->query($sql)) {
		echo "Falló la insercion: (" . $con->errno . ") " . $con->error;
	}
	else
		echo 1;
		$con->close();
	
	//echo json_encode($jsondata);
	
?>