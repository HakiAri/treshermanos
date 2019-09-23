<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php"); 
    

    if(isset($_REQUEST["id_user"])){
        $id_user = $_REQUEST["id_user"];
        $sql="SELECT c.id_curso, c.grado, c.paralelo, a.nombre_asignatura,a.id_asignatura FROM  docente as d RIGHT JOIN tiene as t on d.id_docente = t.id_docente RIGHT JOIN curso as c on c.id_curso = t.id_curso RIGHT JOIN asignatura as a on a.id_asignatura = t.id_asignatura WHERE d.id_user = {$id_user}";
        //echo $sql;
        if($result = $con->query($sql)){
            if($result->num_rows > 0){
                $json['estado']="s";
                //$jsondata['estado']="correcto";
                //while ($row = $result->fetch_array() ) {
                while ($row = $result->fetch_object() ) {
                    $json['curso'][]=$row;                   
                }
            }else{
                $json['estado']="s";
                $curso="";//No existe registros en la consulta
                $json['curso'][]=$curso;
            }
        }else{
            $json['estado']="n";//Error de usuario no encuentra
        }
        echo json_encode($json);
    }else{
        $json['estado']="n";//Error de usuario no encuentra
        echo json_encode($json);
    }    
    $con->close();
?>