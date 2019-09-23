<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 
        
	$id = trim($_REQUEST["id_eliminar"]);

	$sql = "UPDATE stocks set estado=0 where id_stock={$id}";

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

	