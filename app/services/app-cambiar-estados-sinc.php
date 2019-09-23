<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 
    
    $json=array();
    
        $sql="UPDATE `stocks` SET `sinc_estado`='0' WHERE  `sinc_estado`= 2;";              
        //var_dump($sql);
	if (!$con->query($sql)) {
        $json['estado']="n";		
	}
	else{        
        $json['estado']="s";
    }
    echo json_encode($json);   
      
    $con->close();
?>