<?php 
	# conectare la base de datos
    $con= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $con->set_charset('utf8');
    $zonaHoraria = "SET TIME_ZONE='-04:00';";
    if($con->connect_errno){
        die("imposible conectarse: (".$con->connect_errno.") ".$con->connect_error);
    }
    $con->query($zonaHoraria);

    function conectar(){
		$con= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $con->set_charset('utf8');
        $zonaHoraria = "SET TIME_ZONE='-04:00';";
	    if($con->connect_errno){
	        die("imposible conectarse: (".$con->connect_errno.") ".$con->connect_error);
	    }
        $con->query($zonaHoraria);
	    return $con;
    }

    function desconectar($conexion){
    	$conexion->close();
    }
?>