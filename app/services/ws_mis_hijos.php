<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 
    
    $json=array();
    if(isset($_REQUEST["id_tutor"])){
        $id_tutor = $_REQUEST["id_tutor"];
        $sql="SELECT e.nombre, e.paterno, e.materno, e.sexo, e.id_rude, k.id_kardex, e.estado,c.grado,c.paralelo
        FROM encargado as ec 
        LEFT JOIN  estudiante e ON ec.id_rude=e.id_rude 
        LEFT JOIN  kardex k ON k.id_rude = e.id_rude 
        LEFT JOIN  curso c ON c.id_curso = k.id_curso 
        WHERE ec.id_tutor = {$id_tutor}";
              
        if($result = $con->query($sql)){
            if($result->num_rows > 0){
                $json['estado']="s";                 
                while ($row = $result->fetch_object()) {
                    $json['estudiantes'][]=$row;                                                    
                }
            }else{
                $estudiantes="";//No existe registros en la consulta
                $json['estado']="n"; 
                $json['estudiantes'][]=$estudiantes;
                
            }
        }else{
            $json['estado']="n"; 
            $estudiantes=$sql;
            $json['estudiantes'][]=$estudiantes;
             
        }
        echo json_encode($json);
    }else{
        $json['estado']="n"; //Error de usuario no encuentra
        $json['estudiantes'][]=$id_tutor;
        echo json_encode($json);
    } 
      
    $con->close();
?>