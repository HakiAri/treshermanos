
<div aria-hidden="true" aria-labelledby="myModalLabel" data-backdrop="static" role="dialog" tabindex="-1" id="modal_Registrar" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">REGISTRO DE NUEVO STOCK</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form class="cmxform form-horizontal adminex-form" id="frmTutor" name="frmTutor" method="post">
							<div class="form-group ">
								<label for="descripcion" class="control-label col-lg-4">Descripcion</label>
								<div class="col-lg-8">
									<input class=" form-control" id="descripcion" name="descripcion" minlength="3 " type="text" required autofocus="true"/>
								</div>
							</div>

							<div class="form-group ">
								<label for="cantidad" class="control-label col-lg-4">Cantidad</label>
								<div class="col-lg-8">
									<input class="form-control " id="cantidad" type="number" name="cantidad"  />
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button class="btn btn-primary" type="submit" id="btnRegistrar">Registrar</button>
								</div>
							</div>
							
						</form>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>