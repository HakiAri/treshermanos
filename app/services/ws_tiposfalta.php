<?php
	require_once ("../config/db.php");
    require_once ("../config/conexion.php"); 
    

    
    $json=array();
    if(isset($_REQUEST["falta"])){

        $falta = $_REQUEST["falta"];
        $sql="SELECT * FROM faltas as f WHERE f.estado = 1 AND tipoFalta='{$falta}'";
       
        if($result = $con->query($sql)){
            if($result->num_rows > 0){
                $json['estado']="s";                 
                while ($row = $result->fetch_object()) {
                    $json['faltas'][]=$row;                                                    
                }
            }else{
                $json['estado']="n"; 
                $json['faltas'][]=$faltas;
                
            }
        }else{
            $json['estado']="n"; 
            $json['faltas'][]=$faltas;
             
        }
        echo json_encode($json);
    }else{
        $json['estado']="s"; 
        $json['faltas'][]=$faltas;
        echo json_encode($json);
    }
    
    $con->close();
?>