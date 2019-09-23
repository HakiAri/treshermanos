<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 
    
    $json=array();
    if(isset($_REQUEST["id_docente"])){
        $id_docente = $_REQUEST["id_docente"];
        
        $sql="SELECT DISTINCT(c.id_curso) AS id_curso
        , c.grado, c.paralelo
        FROM curso c
        , kardex k
        WHERE c.id_curso=k.id_curso AND k.id_asesor = {$id_docente}
            AND k.gestion=YEAR(NOW())";
        //echo $sql;
        if($result = $con->query($sql)){
            if($result->num_rows > 0){
                $json['estado']="s";                
                while ($row = $result->fetch_object()) {
                    $json['acesor'][]=$row;                                                    
                }
            }else{
                $json['estado']="n"; //No existe registros en la consulta
                $json['acesor'][]=$sql;                
                               
            }
        }else{
            $json['estado']="n";
            $json['acesor'][]=$id_docente; 
                       
        }
        echo json_encode($json);
    }else{
        $json['estado']="n";//Error de usuario no encuentra
        $json['acesor'][]="No se encuentra";
        echo json_encode($json);
    } 
      
    $con->close();
?>