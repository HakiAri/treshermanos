<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 
    // RIGHT JOIN faltas_cometidas fc ON fc.id_kardex=k.id_kardex AND DATE(fc.fecha)='{$fecha}'
    $json=array();
    if(isset($_REQUEST["id_rude"])){
        $id_rude = $_REQUEST["id_rude"];
        //$fecha = $_REQUEST["fecha"];
        //$sql="SELECT k.gestion, f.tipoFalta, f.descripcion, fc.obseracion, fc.fecha, a.nombre_asignatura FROM kardex as k RIGHT JOIN faltas_cometidas fc ON fc.id_kardex=k.id_kardex  RIGHT JOIN faltas f ON f.id_falta = fc.id_falta RIGHT JOIN asignatura a ON a.id_asignatura = fc.id_asignatura WHERE k.id_rude = {$id_rude}";
        
        $fecha = $_REQUEST["fecha"];
        $sql="SELECT k.gestion, f.tipoFalta, f.descripcion, fc.obseracion, fc.fecha, a.nombre_asignatura FROM kardex as k RIGHT JOIN faltas_cometidas fc ON fc.id_kardex=k.id_kardex  RIGHT JOIN faltas f ON f.id_falta = fc.id_falta RIGHT JOIN asignatura a ON a.id_asignatura = fc.id_asignatura WHERE k.id_rude = {$id_rude}";
        
        //echo $sql;
        if($result = $con->query($sql)){
            if($result->num_rows > 0){
                $json['estado']="s";               
                while ($row = $result->fetch_object()) {
                    $json['faltashijo'][]=$row;                                                    
                }
            }else{
                $json['estado']="n";
                //$json['faltashijo'][]="";                
                               
            }
        }else{
            $json['estado']="n";
            //$json['faltashijo'][]=""; 
                       
        }
        echo json_encode($json);
    }else{
        $json['estado']="n";//Error de usuario no encuentra
        //$json['faltashijo'][]=$id_rude;
        echo json_encode($json);
    } 
      
    $con->close();
?>