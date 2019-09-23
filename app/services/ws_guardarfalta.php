<?php 
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 


    //$observacion = $trim($_GET["observacion"]);
    $observacion = trim($_REQUEST["obs"]);
    //$contador    = $trim($_REQUEST["contador"]);
    $contador    = 0;
    $estado      = 1;
    $fecha       = trim($_REQUEST["fecha"]);
    $id_kardex   = trim($_REQUEST["id_kardex"]);
    $id_user     = trim($_REQUEST["id_user"]);
    $id_falta    = trim($_REQUEST["id_falta"]);
    $id_asignatura    = trim($_REQUEST["id_asignatura"]);
    
	$sql = "INSERT INTO `faltas_cometidas` (`id_fal_com`, `obseracion`, `contador`, `fecha`, `estado`, `id_kardex`, `id_user`, `id_falta`,`id_asignatura`) VALUES  (null,'{$observacion}','{$contador}',NOW(),'{$estado}','{$id_kardex}','{$id_user}','{$id_falta}','{$id_asignatura}')";
    //echo $sql;
	if (!$con->query($sql)) {        
        $json['estado']="n";//No existe registros en la consulta
        $json['faltasave'][]="NO";
	}
	else{
        $json['estado']="s";//Registrado correctamente
        $json['faltasave'][]="SI";
    }
    echo json_encode($json);
	$con->close();
?>