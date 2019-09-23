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
	$titulo="Stock";
	$contenido="stock/index.php";
	$subTitulo="Stocks";
	$menu_a= $menus['UE_PADRE'];

	/*	if (!($tutores = $con->query("SELECT * FROM tutor where estado = 1 "))) {
    	echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
	}*/
	
	if (!($stocks = $con->query("SELECT * FROM stocks  where estado=1 "))) {
    	echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
	}
	$con->close();
	
	/*$con=conectar();
	if (!($cursos = $con->query("SELECT * FROM curso where estado = 1 "))) {
    	echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
	}
	$con->close();*/
	$pie_class="si";//Variable donde se poneun pie de pagina estatico	
	require_once ('../../../public/views/plantilla.php');
?>