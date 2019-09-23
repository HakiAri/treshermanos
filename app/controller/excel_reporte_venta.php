<?php
require_once('../config/db.php');
require_once('../config/conexion.php');
require_once('../librarys/phpexcel/Classes/PHPExcel.php');
require_once('../config/route.php');

// Resivimos las variables de fechas

$id_stock = trim($_REQUEST["id_stock"]);

$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');


$objPHPExcel = new PHPExcel();
/**/
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load('templatereporte.xlsx');
//$objPHPExcel = $objReader->load('excel/templateequipmentjob.xlsx');

// Indicamos que se pare en la hoja uno del libro
$objPHPExcel->setActiveSheetIndex(0);

$con=conectar();
	$sql_1="SELECT * FROM stocks WHERE id_stock='{$id_stock}'";
	if (!($stocks = $con->query($sql_1))) {
    	echo "Falló SELECT: (" . $con->errno . ") " . $con->error;
    }
    
     foreach ($stocks as $stock){
        $objPHPExcel->getActiveSheet()->SetCellValue('C6',$stock['id_stock']." - ".date("d/m/Y", strtotime($stock['fecha_inicio']))." ".$stock['descripcion']);    
     }
$con->close();

$con=conectar();
$sql="SELECT v.id_venta, v.lugar_venta, v.precio, v.cantidad, v.cantidad_total, v.fecha, v.estado 
          FROM ventas v
          WHERE v.stock_id = '{$id_stock}'"; 
//echo $sql;
$res=$con->query($sql);

$line = 10;
$cont = 1;
$total = 0;

foreach ($res as $fila)
{
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$line,$cont);

    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$line,$fila['lugar_venta']);

    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$line,$fila['precio']);

    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$line,$fila['cantidad']);

    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$line,$fila['cantidad_total']);
    
    if($fila['estado'] == "1"){
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$line,"Venta Normal");   
    }else{
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$line,"Venta Total");   
    }
    
    $total = $total + $fila['cantidad_total'];
    $line++;
    $cont++;

}

$objPHPExcel->getActiveSheet()->SetCellValue('D'.$line,"Total");
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$line,$total);
$objPHPExcel->getActiveSheet() ->getStyle('D'.$line.':E'.$line) ->getFont() ->applyFromArray( array( 'name' => 'Arial', 'color' => array( 'rgb' => 'FF0000' ) ) );

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte_ventas_'.date("d-m-Y").'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>