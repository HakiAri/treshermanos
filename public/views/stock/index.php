<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="row panel-heading">
                    LISTADO DE STOCKS
                    <span class="pull-right">
                        <a href="#modal_Registrar" class="btn btn-xs btn-success" data-toggle="modal">
                            <span class="fa fa-pencil"></span> Nuevo Stock
                        </a>
                    </span>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table" >
                    <table  class="display table table-bordered table-striped" id="tbtutor">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Cantidad</th>
                                <th>Vendidos</th>
                                <th>Fecha entrega</th>
                                <th>Fecha Conclucion</th>
                                <th class="center"> Acciones</th>
                            </tr>
                        </thead>
                    <tbody>
                            <?php foreach ($stocks as $stock): ?>
                                <tr class="gradeX">
                                    <td><?php echo $stock['descripcion']; ?></td>
                                    <td><?php echo $stock['cantidad']; ?></td>
                                    <td><?php echo $stock['vendido']; ?></td>
                                    <td><?php echo $stock['fecha_inicio']; ?></td>
                                    <td><?php echo $stock['fecha_fin']; ?></td>
                                    <td >
                                       
                                        <a class="btn btn-danger" href="#modalEliminar" role="button" data-toggle="modal" data-placement="top" title="Eliminar" onclick="eliminar_datos(<?php echo $stock['id_stock'] ?>)">
                                            <span class="fa fa-trash-o"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php require_once 'modal_registrar.php'; ?>
        <?php require_once 'modal_eliminar.php'; ?>
        <?php require_once 'modal_editar.php'; ?>
    </section>
</div>
</div>
<script>
    function registro( id ) {
        var idt=$("#id_tutorV").val();
        $.ajax( {
            url: '../../models/tutor/registro_encargado.php',
            type: 'POST',
            dataType: "json",
            data: {
                id_tutor: idt,
                id_rude: id
            },
            success: function ( datos ) {
                var idt=$("#id_tutorV").val();
                var miid=$("#id_curso").val();
                $("#tabla_estudiante").load("../../models/tutor/estudiante_curso.php?id_curso="+miid+"&id_tutor="+idt);
                if ( datos == 1 ) {
                    mensajes_alerta_pequeño( 'Se adiciono correctamente !! ', 'success', 'Adición' );
                } else {
                    mensajes_alerta_pequeño( 'Error al adicionar verifique los datos!! ' + response, 'error', 'Adición' );
                }

            }
        } );
    }
    function obtener_datos(id){
        $.ajax({
            url: '../../models/tutor/datos_tutor.php',
            type: 'POST',
            dataType: "json",
            data: {id_tutor: id},
            success: function(datos){
                //console.log(datos);
                $("#frmEditar [id=id_tutor]").val(datos['tutor']['id_tutor']);
                $("#frmEditar [id=nombres]").val(datos['tutor']['nombres']);
                $("#frmEditar [id=paterno]").val(datos['tutor']['paterno']);
                $("#frmEditar [id=materno]").val(datos['tutor']['materno']);
                $("#frmEditar [id=celular]").val(datos['tutor']['celular']);
                $("#frmEditar [id=telefono]").val(datos['tutor']['telefono']);
                $("#frmEditar [id=domicilio]").val(datos['tutor']['domicilio']);

            }
        });
    }
    function eliminar_datos(id){
        $("#id_eliminar").val(id);
    }
    
    $(document).ready(function(){
         $("#id_curso").chosen({
            disable_search_threshold: 10,
            no_results_text: "No se encontro resultados!",
            width: "95%"
        });

        $("#id_curso").change(function() {
            var idt=$("#id_tutorV").val();
            var miid=$("#id_curso").val();
            $("#tabla_estudiante").load("../../models/tutor/estudiante_curso.php?id_curso="+miid+"&id_tutor="+idt);
        });
        $("#tbtutor").dataTable();
        $("#frmTutor").validate({
            debug:true,
            rules:{
                descripcion:{
                    required:true,
                    minlength: 3,
                    maxlength:15,
                },
                cantidad:{
                    required:true,
                    minlength: 1,
                    maxlength:12,
                }
            },
            messages:{
                descripcion:{
                    required:"Este es Campo es obligatorio escriba una descripcion.",
                },
                cantidad:{
                    required:"Este es Campo Obligatorio escriba una cantidad para el stock.",
                },
               
            },
            submitHandler: function (form) {
                $.ajax({
                    url: '../../models/stock/registro_model.php',
                    type: 'post',
                    dataType:"json",
                    data: $("#frmTutor").serialize(),
                    beforeSend: function() {
                        transicion("Procesando Espere....");
                    },
                    success: function(response) {
                        if(response =='1' ){
                            $('#modal_Registrar').modal('hide');
                            transicionSalir();
                            mensajes_alerta('DATOS GUARDADOS EXITOSAMENTE !! ','success','GUARDAR DATOS');
                            setTimeout(function(){
                                window.location.href='<?php echo ROOT_CONTROLLER ?>stock/index.php';
                            }, 3000);
                        }else{
                            transicionSalir();
                            mensajes_alerta('ERROR AL REGISTRAR EL STOCK  verifique los datos!! '+response,'error','GUARDAR DATOS');
                        }
                    }
                });
            }
        });

        $("#btnEliminar").click(function(event) {
            $.ajax({
                url: '../../models/stock/eliminar_model.php',
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
                        mensajes_alerta('DATOS ELIMINADOS EXITOSAMENTE !! ','success','EDITAR DATOS');
                        setTimeout(function(){
                            window.location.href='<?php echo ROOT_CONTROLLER ?>stock/index.php';
                        }, 3000);
                    }else{
                        transicionSalir();
                        mensajes_alerta('ERROR AL ELIMINAR EL STOCK verifique los datos!! '+response,'error','EDITAR DATOS');
                    }
                }
            });
        });
    });
</script>