<?php 
    require_once ("../../config/db.php");
    require_once ("../../config/conexion.php");
    $id=$_REQUEST['id_curso'];

    // $sql="call listadelCurso({$id})";
    $sql="SELECT v.id_venta, v.lugar_venta, v.precio, v.cantidad, v.cantidad_total, v.fecha, v.estado 
          FROM ventas v
          WHERE v.stock_id = '{$id}'";

    $ventas = $con->query($sql);
    $con->close();
?>
<div class="adv-table" >
    <table  class="display table table-bordered table-striped" id="tbEstudiante">
        <thead>
            <tr>
                <th class="col-md-4">Lugar Venta </th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Fecha de Venta</th>
                <th>Tipo Venta</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta): ?>
                <tr class="gradeX">
                    <td><?php echo $venta['lugar_venta']; ?></td>
                    <td class="text-center"><?php echo $venta['precio']; ?></td>
                    <td class="text-center"><?php echo $venta['cantidad']; ?></td>
                    <td class="text-center"><?php echo $venta['cantidad_total']; ?></td>
                    <td><?php echo date("d/m/Y", strtotime($venta['fecha'])); ?></td> 
                    <td><?php echo ($venta['estado']==1)? 'Venta Normal':'Venta Total' ?></td> 
                    <td >
                        <a class="btn btn-danger" href="#modalEliminar" role="button" data-toggle="modal" data-placement="top" title="Eliminar" onclick="eliminar_venta(<?php echo $venta['id_venta'] ?>)">
                            <span class="fa fa-trash-o"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $("#tbEstudiante").dataTable();
    });
</script>