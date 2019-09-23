<?php 
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 

    $id_kardex   = trim($_REQUEST["id_kardex"]);
    $citacion   = trim($_REQUEST["citacion"]);
    $fechayhora = trim($_REQUEST["fechayhora"]);
    
	$sql = "INSERT INTO citacion (id_citacion, tipo, citacion, fecha, fecha_registro, estado, id_kardex) VALUES (NULL, 'estandar', '{$citacion}', '{$fechayhora}',NOW(), 1, {$id_kardex})";
    //echo $sql;
	if (!$con->query($sql)) {
        //echo "Falló la insercion de citacion: (" . $con->errno . ") " . $con->error;
        $json['estado']="n";//No existe registros en la consulta
        $json['citacion'][]=$sql;
	}
	else{
        $json['estado']="s";//Registrado correctamente
        $json['citacion'][]="SI";
    }
    echo json_encode($json);
	$con->close();
?>