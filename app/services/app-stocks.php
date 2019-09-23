<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 
    
    $json=array();
    
        $sql="SELECT *
        FROM stocks WHERE estado = 1";
              
        if($result = $con->query($sql)){
            if($result->num_rows > 0){
                $json['estado']="s";                 
                while ($row = $result->fetch_object()) {
                    $json['stocks'][]=$row;                                                    
                }
            }else{
                $stocks="";//No existe registros en la consulta
                $json['estado']="n"; 
                $json['stocks'][]=$stocks;
                
            }
        }else{
            $json['estado']="n"; 
            $stocks=$sql;
            $json['stocks'][]=$stocks;
             
        }
        echo json_encode($json);
    
      
    $con->close();
?>