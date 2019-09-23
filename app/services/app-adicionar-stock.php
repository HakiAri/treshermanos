<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 
        
	$descripcion   = trim($_POST["descripcion"]);
	$cantidad   = trim($_POST["cantidad"]);
	$fecha = trim($_POST["fecha"]);
	$hora  = trim($_POST["hora"]);
	
	$sql = "INSERT INTO `stocks` (`descripcion`, `cantidad`, `vendido`, `fecha_inicio`, `fecha_fin`, `hora_inicio`, `hora_fin`, `usuario_id`, `estado`, `sinc_estado`)
			VALUES ('{$descripcion}', '{$cantidad}', '0', '{$fecha}', '0000-00-00', '{$hora}', '00:00:00', '2', '1','2');";
	//var_dump($sql);
	if (!$con->query($sql)) {
        $json['estado']="n";
		//echo "Falló la insercion: (" . $con->errno . ") " . $con->error;
	}
	else{
        //echo 1;
        $json['estado']="s";
    }

    echo json_encode($json);
    
      
    $con->close();
?>