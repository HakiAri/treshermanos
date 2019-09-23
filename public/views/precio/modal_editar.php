<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalEditar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Editar Rol</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="frmEditar" name="frmEditar">
                    <input type="hidden" name="id_m" id="id_m" class="form-control" value="">
                    <div class="form-group">
                        <label for="precio_m">Precio (Obligatorio)</label>
                        <input class=" form-control" id="precio_m" name="precio_m" minlength="1" type="number" required autofocus="true" />
                    </div><br>
                    <div class="form-group">
                        <label for="descripcion_m">Descripcion (Obligatorio)</label>
                        <input class=" form-control" id="descripcion_m" name="descripcion_m" minlength="1" type="text" required autofocus="" />
                    </div><br>
                    <br>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnEditar" id="btnEditar">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>