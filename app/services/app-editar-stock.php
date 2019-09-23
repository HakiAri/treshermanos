<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 
        
	$descripcion = trim($_POST["descripcion"]);
	$cantidad    = trim($_POST["cantidad"]);
	$fecha       = trim($_POST["fecha"]);
    $hora        = trim($_POST["hora"]);
    $id_stock    = trim($_POST["id_stock"]);
	
	$sql = "UPDATE `stocks` SET `descripcion`='{$descripcion}',`cantidad`='{$cantidad}',`fecha_inicio`='{$fecha}',`hora_inicio`='{$hora}' WHERE  `id_stock`='{$id_stock}'";
			
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