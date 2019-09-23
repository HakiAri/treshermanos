<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 
    // RIGHT JOIN faltas_cometidas fc ON fc.id_kardex=k.id_kardex AND DATE(fc.fecha)='{$fecha}'
    $json=array();
    if(isset($_REQUEST["id_docente"])){
        $id_docente = $_REQUEST["id_docente"];
        $fecha = $_REQUEST["fecha"];
        $sql="SELECT d.id_user, c.grado, c.paralelo, a.nombre_asignatura , CONCAT(e.nombre,' ',e.paterno,' ',e.materno) as nombrecompleto, fc.fecha,f.descripcion, fc.id_fal_com
        FROM docente as d         
        INNER JOIN faltas_cometidas fc ON fc.id_user = d.id_docente 
        INNER JOIN faltas f ON f.id_falta = fc.id_falta
        INNER JOIN kardex k ON k.id_kardex = fc.id_kardex
        INNER JOIN estudiante e ON e.id_rude = k.id_rude
        INNER JOIN curso c ON c.id_curso = k.id_curso
        INNER JOIN asignatura a ON fc.id_asignatura = a.id_asignatura
        WHERE d.id_docente = {$id_docente} ORDER BY fc.fecha DESC";
        //echo $sql;
        if($result = $con->query($sql)){
            if($result->num_rows > 0){
                $json['estado']="s";               
                while ($row = $result->fetch_object()) {
                    $json['faltasdocente'][]=$row;                                                    
                }
            }else{
                $json['estado']="n";
                //$json['faltasdocente'][]="";                
                               
            }
        }else{
            $json['estado']="n";
            //$json['faltasdocente'][]=""; 
                       
        }
        echo json_encode($json);
    }else{
        $json['estado']="n";//Error de usuario no encuentra
        //$json['faltasdocente'][]=$id_rude;
        echo json_encode($json);
    } 
      
    $con->close();
?>