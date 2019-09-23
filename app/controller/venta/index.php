<?php
	require_once '../../config/route.php';
	session_start();
	if (!isset($_SESSION['<us></us>er_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ".ROOT_CONTROLLER.'login/');
		exit;
	}
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	//Variables para enviar a la plantilla
	$titulo="Ventas Realizadas";
	$contenido="venta/index.php";
	$subTitulo="Ventas Realizadas";
	$menu_a= $menus['UE_ESTUDIANTE'];

	if (!($ventas = $con->query("SELECT * FROM ventas where estado = 1 "))) {
    	echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
	}
	$con->close();

	$con=conectar();
	$sql_1="SELECT * FROM stocks WHERE 1=1";
	if (!($stocks = $con->query($sql_1))) {
    	echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
	}
	$con->close();

	require_once ('../../../public/views/plantilla.php');
?>