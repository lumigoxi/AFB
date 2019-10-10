@extends('layouts.app')
@section('content')
<main class="carrusel">
	<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-pause="false">
		<div class="carousel-inner">
			<div class="carousel-item-active">
				<img class="d-block w-100" src="img\carrusel-3.jpg" alt="mas perros xdxdxd">
			</div>
			<div class="overlay">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-8 offset-md-2 text-center text-md-center">
							<h1>Tu ayuda es muy importante</h1>
							<h4>Ayudanos a ayudar</h4>
							<button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalContact">Contactanos</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<section>
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-4 text-center py-2">
				<h5>
				La importancia de ayudar
				</h5>
				<p class="text-secondary">
					Ayuda es un acto de bondad y humildad, Amigo Fiel tiene la idea de que si todos nos unimos y aportamos, podemos	cambiar la vida de muchos animalitos.
					
				</p>
			</div>
			<div class="col-md-4 text-center py-2">
				<h5>
				Trabaja con nosotros
				</h5>
				<p class="text-secondary">
					Amigo fiel necesita de más personas comprometidas para seguir creciendo y
					trabajando por el binestar de los animales callejores.
				</p>
			</div>
			<div class="col-md-4 text-center py-2">
				<h5>
				Gratificación
				</h5>
				<p class="text-secondary">
					La felicidad no tiene precio.
					<br>
					Adopta, no compres.
				</p>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="modalContact" tabindex="-1" role="dialog" aria-labelledby="formContact" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mx-auto">
				<h5 class="modal-title" id="modalContactId">Contactanos</h5>
			</div>
			<div class="modal-body pt-1">
				<form id="formContact">
					@csrf
					<div class="row form-group mb-0">
						<div class="col-md-6">
							<label for="name">Nombre</label>
							<input type="text" class="form-control" placeholder="Nombre" id="name" name="name" value="sdbhdsabhd">
							<span class="msgDanger-name"></span>
						</div>
						<div class="col-md-6">
							<label for="lastName">Apellido</label>
							<input type="text" class="form-control" placeholder="Apellido" id="lastName" name="lastName" value="sdbhdsabhd">
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
						<label for="reason">Motivo</label>
						<select class="form-control" id="reason" name="reason">
							<option value="1">Selecione una opción</option>
							<option value="2">Colaborar</option>
							<option value="3">Rescate</option>
							<option value="4">Otro(Espicificar)</option>
						</select>
						<span class="msgDanger-reason"></span>
					</div>
					<div class="row form-group mb-2">
						<label for="description">Mensaje <span>(Opcional)</span></label>
						<textarea class="form-control" id="description" rows="2" name="message"></textarea>
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
@endsection