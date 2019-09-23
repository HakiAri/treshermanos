<?php

//Desarrolador: Laiwett feat LYA
require_once ("../config/db.php");
require_once ("../config/conexion.php");    


    //Obtenemos los datos
    $Id = trim($_POST['id']);
    $LugarVenta = trim($_POST['lugar_venta']);
    $Precio = trim($_POST['precio']);
    $Cantidad = trim($_POST['cantidad']);
    $CantidadTotal = trim($_POST['cantidad_total']);
    $Fecha = trim($_POST['fecha']);
    $Observacion = trim($_POST['observacion']);
    $TipoVenta = trim($_POST['tipo_venta']);
    $Estado = trim($_POST['estado']);
    $PrecioId = trim($_POST['precio_id']);
    $StockId = trim($_POST['stock_id']);
    $UsuarioId = trim($_POST['usuario_id']);   
 
        $con=conectar();
        $sql = "INSERT INTO `ventas` (`id_venta_sync`,`lugar_venta`, `precio`, `cantidad`, `cantidad_total`, `fecha`, `observacion`, `tipo_venta`, `estado`, `precio_id`, `stock_id`, `usuario_id`) 
              VALUES ('{$Id}','{$LugarVenta}', '{$Precio}', '{$Cantidad}', '{$CantidadTotal}', '{$Fecha}', '{$Observacion}', '{$TipoVenta}', '{$Estado}', '{$PrecioId}', '{$StockId}', '{$UsuarioId}')";
       
       //var_dump($sql);

       if (!$con->query($sql)) {        
            $json['estado']="NO";//No existe registros en la consulta
            
        }else{
            $json['estado']="OK";//Registrado correctamente           
        }
        
        $con->close();       
 

    //Devulve el json
    echo json_encode($json);
	//$con->close();
?>


