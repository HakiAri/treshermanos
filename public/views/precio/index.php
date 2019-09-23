<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Lista de usuarios
                <span class="tools pull-right">
                    <!--a href="<?php echo ROOT_CONTROLLER; ?>precio/registro.php" class="fa fa-plus"></a-->
                 </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th>Precio</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($precios as $precio): ?>
                                <tr class="gradeX">
                                    <td><?php echo $precio['precio']; ?></td>
                                    <td><?php echo $precio['descripcion']; ?></td>
                                    <td><?php echo ($precio['estado']==1 ?'Activo':'Desactivado'); ?></td>
                                    <td><?php echo ($precio['estado']==1 ?'Activo':'Desactivado'); ?></td>
                                    <!--td class="text-center">
                                        <a class="btn btn-success" href="#modalEditar" role="button" data-placement="top" title="Editar" data-toggle="modal" onclick="obtener_datos(<?php echo $precio['id'] ?>)">
                                            <span class="fa fa-edit" ></span></a>
                                        <a class="btn btn-danger" href="#modalEliminar" role="button" data-toggle="modal" data-placement="top" title="Eliminar" onclick="eliminar_datos(<?php echo $precio['id'] ?>)">
                                            <span class="fa fa-trash-o"></span>
                                        </a>
                                    </td-->
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Precio</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <?php require_once 'modal_editar.php'; ?>
            <?php require_once 'modal_eliminar.php'; ?>
        </section>
    </div>
</div>

 <script>
    function obtener_datos(id){
        console.log(id);
        $.ajax({
            url: '../../models/precio/datos_precios.php',
            type: 'POST',
            dataType: "json",
            data: {id: id},
            success: function(datos){
                console.log(datos);
                $("#precio_m").val(datos['precios']['precio']);
                $("#descripcion_m").val(datos['precios']['descripcion']);
                $("#id_m").val(datos['precios']['id']);
                //console.log(datos['usuario']['name']);
            }
        });
    }
    function eliminar_datos(id){
        $("#id").val(id);
    }
    $(document).ready(function() {
        $("#btnEliminar").click(function(event) {
            $.ajax({
                url: '../../models/precio/eliminar_model.php',
                type: 'POST',
                data: $("#frmEliminar").serialize(),
                success: function(datos){
                    ('#modalEliminar').modal('hide');
                    $('#btnEliminar').attr({
                        disabled: 'true'
                    });
                    transicionSalir();
                    mensajes_alerta('DATOS ELIMINADOS ELIMINADOS EXITOSAMENTE !! ','success','EDITAR DATOS');
                    setTimeout(function(){
                        window.location.href='<?php echo ROOT_CONTROLLER ?>user/index.php';
                    }, 3000);
                }
            });
        });
        $('#frmEditar').validate({
            debug:true,
            rules:{
                precio:{
                    required:true,
                    minlength: 1,
                },
                descripcion:{
                    required:true,
                    minlength: 3,
                },
            },
            messages:{
                precio:{
                    remote:"debe ser un numero."
                }                
            },
            submitHandler: function (form) {
                $.ajax({
                    url: '../../models/precio/editar_model.php',
                    type: 'post',
                    data: $("#frmEditar").serialize(),
                    beforeSend: function() {
                        transicion("Procesando Espere....");
                    },
                    success: function(response) {
                        if(response==1){
                            $('#modalEditar').modal('hide');
                            $('#btnEditar').attr({
                                disabled: 'true'
                            });
                            transicionSalir();
                            mensajes_alerta('DATOS EDITADOS EXITOSAMENTE !! ','success','EDITAR DATOS');
                            setTimeout(function(){
                                window.location.href='<?php echo ROOT_CONTROLLER ?>precio/precios.php';
                            }, 3000);
                        }else{
                            transicionSalir();
                            mensajes_alerta('ERROR AL EDITAR EL USUARIO verifique los datos!! '+response,'error','EDITAR DATOS');
                        }
                    }
                });
            }
        });

        $('#btnReset').click(function(event) {
            $.ajax({
                url: '../../models/user/reset_model.php',
                type: 'post',
                data: {
                    id: function() {
                            return $("#inputId").val();
                        }                    
                },
                beforeSend: function() {
                    transicion("Procesando Espere....");
                },
                success: function(response) {
                    if(response==1){
                        $('#modalEditar').modal('hide');
                        $('#btnReset').attr({
                            disabled: 'true'
                        });
                        $('#btnEditar').attr({
                            disabled: 'true'
                        });
                        transicionSalir();
                        mensajes_alerta('PASSWORD RESTABLECIDO !! ','success','RESTABLECER CONTRASEÑA');
                        setTimeout(function(){
                            window.location.href='<?php echo ROOT_CONTROLLER ?>user/index.php';
                        }, 3000);
                    }else{
                        transicionSalir();
                        mensajes_alerta('ERROR RESTABLECER LA CONTRASEÑA !! '+response,'error','RESTABLECER CONTRASEÑA');
                    }
                }
            })
        });
    });
</script>