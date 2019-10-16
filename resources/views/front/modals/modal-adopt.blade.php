<div class="modal fade" id="modalAdopt" tabindex="-1" role="dialog" aria-labelledby="formContact" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mx-auto">
				<h5 class="modal-title" id="modalContactId"></h5>
			</div>
			<div class="modal-body pt-1">
				<form id="formAdopt">
					@csrf
					<div class="row form-group mb-0">
						<div class="col-md-6">
							<label for="name">Nombre</label>
							<input type="text" class="form-control" placeholder="Nombre" id="name" name="name">
							<span class="msgDanger-name"></span>
						</div>
						<div class="col-md-6">
							<label for="lastName">Apellido</label>
							<input type="text" class="form-control" placeholder="Apellido" id="lastName" name="lastName">
							<span class="msgDanger-lastName"></span>
						</div>
					</div>
					<div class="row form-group mb-0 pb-0">
						<div class="col-md-7 pb-0">
							<label for="email">Correo</label>
							<input type="email" class="form-control" id="email" placeholder="amigo@fiel.com" name="email">
							<span class="msgDanger-email"></span>
						</div>
						<div class="col-md-5 pb-0">
							<label for="tel">Teléfono</label>
							<input class="form-control" type="tel" id="tel" name="telephone" placeholder="11223344">
							<span class="msgDanger-tel"></span>
						</div>
					</div>
					<div class="row form-group mb-2">
						<label for="message">Mensaje <span>(Obligatorio)</span></label>
						<textarea class="form-control" id="message" rows="2" name="message" placeholder="Cuentanos por qué quieres adoptar a esta mascota, esta información es muy valiosa para nosotros :)"></textarea>
						<span class="msgDanger-msg"></span>
					</div>
					<div class="row form-group mb-2">
						<div class="col-md-3">
							<label for="">Contactar vía:</label>
						</div>
						<div class="col-md-9">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" class="custom-control-input" id="check-tel" name="contactTel">
								<label class="custom-control-label" for="check-tel">Teléfono</label>
								<span class="msgDanger-check"></span>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" class="custom-control-input" id="check-email" name="contactEmail">
								<label class="custom-control-label" for="check-email">Correo</label>
								<span class="msgDanger-check"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class = "g-recaptcha" id="ContactRecaptcha" 
           						data-sitekey = "{{env ('GOOGLE_RECAPTCHA_KEY')}}"> 
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="sumbit" class="btn btn-success">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>