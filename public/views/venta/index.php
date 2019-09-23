<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="row panel-heading">
                    Listado de Ventas
                </div>
            </header>
            <div class="panel-body">
                <!-- <form class="form-horizontal adminex-form"> -->                   

                    <div class="form-group">
                        <label class="col-lg-3 col-md-3 col-xs-6 control-label col-lg-2" for="inputSuccess"><strong>Seleccione tipo de Reporte</strong></label>
                        <div class="col-lg-4 col-md-4 col-xs-6">
                           <select class="chosen-select" id="curso" name="curso" data-placeholder="Seleccione el Stock"  required="">
                                <option value=""></option>
                                <?php foreach ($stocks as $stock): ?>
                                    <option value="<?php echo $stock['id_stock']; ?>" ><?php echo date("d/m/Y", strtotime($stock['fecha_inicio']))." ".$stock['descripcion']; ?></option>
                                <?php endforeach ?>                                                                
                            </select>
                        </div> 
                        <div class="col-lg-5 col-md-5 col-xs-6">
                            <form class="form-horizontal" action="../excel_reporte_venta.php" method="get">
                                <input type="hidden" readonly="" value="" size="16" class="form-control" name="id_stock" id="id_stock">
                                <div class="col-sm-offset-1 col-md-3">
                                    <button type="submit" class="btn btn-info" data-toggle="modal" >Mostrar Reporte Ventas Excel <span class="fa fa-file-text"></span></button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                <!-- </form> -->
                <div id="listado">
                </div>
            </div>
            <?php require_once 'modal_registrar.php'; ?>
            <?php require_once 'modal_eliminar.php'; ?>
            <?php require_once 'modal_editar.php'; ?>
        </section>
    </div>
</div>
<script>
    
    /*function eliminar_datos(id){
        $("#id_eliminar").val(id);
    }*/

    function eliminar_venta(id){
        console.log(id);
        $("#id_eliminar").val(id);
    }

    $(document).ready(function(){
    	$('.cFecha').datepicker({
			format: 'dd/mm/yyyy'
		})
		.on('changeDate', function(ev){
			$('.cFecha').datepicker('hide');
		});
        
        $("#curso").chosen({
            disable_search_threshold: 10,
            no_results_text: "No se encontro resultados!",
            width: "95%"
        });
        $('#curso').change(function(){
            $('#btnr').removeClass('hidden');
            var id=$(this).val();
            $('#id_stock').val(id); 
            $('#id_curso').val(id);            
            $.ajax({
                url: '../../models/venta/listado.php',
                type: 'post',                
                data: {id_curso: id},
                beforeSend: function() {
                    transicion("Procesando Espere....");
                },
                success: function(response) {
                    transicionSalir();
                    $('#listado').html(response);
                }
            });
        });
       
      
        /////////////ELIMINAR DATOS////////////////
        $("#btnEliminar").click(function(event) {
            $.ajax({
                url: '../../models/venta/eliminar_model.php',
                type: 'POST',
                data: $("#frmEliminar").serialize(),
                beforeSend: function() {
                    transicion("Procesando Espere....");
                },
                success: function(response){
                    if(response==1){
                        $('#modalEliminar').modal('hide');
                        $('#btnEliminar').attr({disabled: 'true'});
                        transicionSalir();
                        mensajes_alerta('DATOS ELIMINADOS ELIMINADOS EXITOSAMENTE !! ','success','VENTA');
                        setTimeout(function(){
                            window.location.href='<?php echo ROOT_CONTROLLER ?>venta/index.php';
                        }, 3000);
                    }else{
                        transicionSalir();
                        mensajes_alerta('ERROR AL ELIMINAR LA VENTA verifique los datos!! '+response,'error','VENTA');
                    }
                }
            });
        });
    });

    
</script>