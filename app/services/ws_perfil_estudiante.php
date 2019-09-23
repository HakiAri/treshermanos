<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 
    
    $json=array();
    $json['estado']="s";
    if(isset($_REQUEST["id_rude"])){
        $id_rude = $_REQUEST["id_rude"];
        
        $fecha = $_REQUEST["fecha"];
        $sql="SELECT k.gestion, f.tipoFalta, f.descripcion, fc.obseracion, fc.fecha, a.nombre_asignatura FROM kardex as k RIGHT JOIN faltas_cometidas fc ON fc.id_kardex=k.id_kardex  RIGHT JOIN faltas f ON f.id_falta = fc.id_falta RIGHT JOIN asignatura a ON a.id_asignatura = fc.id_asignatura WHERE k.id_rude = {$id_rude}";
        $nro_faltas = $con->query($sql)->num_rows;
        $a = array("nro"=>$nro_faltas);
            
        //$json['perfil'][]=$a;  

        $sql_uno = "SELECT CONCAT(c.grado,' ',c.paralelo) as curso, CONCAT(d.nombre,' ',d.paterno) as asesor FROM kardex k, curso c, docente d WHERE k.id_rude = {$id_rude} AND d.id_docente = k.id_asesor AND c.id_curso = k.id_curso";
       
        if($result1 = $con->query($sql_uno)){
            if($result1->num_rows > 0){                             
                while ($row = $result1->fetch_object()) {
                    //$json['perfil'][]=$row;                                                    
                    $a ['curso']= $row->curso;
                    $a ['asesor']= $row->asesor;                                                    
                }
            }else{                              
                $a ['curso']= "0";
                $a ['asesor']= "sin asesor";                  
            }
        }else{
            $json['perfil'][]="error en la consulta";                      
        }


        $sql_dos ="SELECT CONCAT(t.nombres,' ',t.paterno,' ',t.materno) as tutor
        FROM encargado e, tutor t
        WHERE e.id_rude = {$id_rude} AND t.id_tutor = e.id_tutor";
        //$nro_faltas = $con->query($sql_dos);

        if($result2 = $con->query($sql_dos)){
            if($result2->num_rows > 0){                             
                while ($row = $result2->fetch_object()) {
                    //$json['perfil'][]=$row; 
                    $a ['tutor']= $row->tutor;                                                   
                }
            }else{                              
                $a ['tutor']= "no asignado tutor";                    
            }
        }else{
            $json['perfil'][]="error en la consulta";                      
        }

        $json['perfil'][]=$a;
              
        echo json_encode($json);
    }else{
        $json['estado']="n";//Error de usuario no encuentra
        //$json['faltashijo'][]=$id_rude;
        echo json_encode($json);
    } 
      
    $con->close();
?>