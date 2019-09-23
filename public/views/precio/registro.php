<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Registro de Precio
            </header>
            <div class="panel-body">
                <div class=" form">
                    <form class="cmxform form-horizontal adminex-form" id="frmPrecio" name="frmPrecio" method="post">
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-2">Precio (Obligatorio)</label>
                            <div class="col-lg-8">
                                <input class=" form-control" id="precio" name="precio" minlength="1 " type="number" required autofocus="true" />
                            </div>  
                        </div>
                        <div class="form-group ">
                            <label for="user" class="control-label col-lg-2">Descripcion (Obligatorio)</label>
                            <div class="col-lg-8">
                                <input class="form-control " id="descripcion" type="text" name="descripcion" required  minlength="3" />
                            </div>
                        </div>                       
                        
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-primary" type="submit" id="btnRegistrar" >Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#frmPrecio").validate({
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
                    remote:"el nombre de usuario ya existe, seleccione otro."
                }                
            },
            submitHandler: function (form) {
                $.ajax({
                    url: '../../models/precio/registro_model.php',
                    type: 'post',
                    data: $("#frmPrecio").serialize(),
                    beforeSend: function() {
                        transicion("Procesando Espere....");
                    },
                    success: function(response) {
                        if(response==1){
                            $('#btnRegistrar').attr({
                                disabled: 'true'
                            });
                            transicionSalir();
                            mensajes_alerta('DATOS GUARDADOS EXITOSAMENTE !! ','success','GUARDAR DATOS');
                            setTimeout(function(){
                                window.location.href='<?php echo ROOT_CONTROLLER ?>precio/precios.php';
                            }, 3000);
                        }else{
                            transicionSalir();
                            mensajes_alerta('ERROR AL REGISTRAR AL USUARIO verifique los datos!! '+response,'error','GUARDAR DATOS');
                        }
                    }
                });
            }
        });
    });
</script>