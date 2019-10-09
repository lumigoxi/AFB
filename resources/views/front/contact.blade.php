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
		<div class="modal-content" style="border-radius: 25px">
			<div class="modal-header mx-auto">
				<h5 class="modal-title" id="modalContactId">Contactanos</h5>
			</div>
			<div class="modal-body">
				<form>
					<div class="row form-group">
						<div class="col-md-6">
							<label for="name">Nombre</label>
							<input type="text" class="form-control" placeholder="Nombre" id="name" name="name">
						</div>
						<div class="col-md-6">
							<label for="lastName">Apellido</label>
							<input type="text" class="form-control" placeholder="Apellido" id="lastname" name="lastName">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-7">
							<label for="email">Correo</label>
      						<input type="email" class="form-control" id="email" placeholder="amigo@fiel.com" name="email">
						</div>
						<div class="col-md-5">
							<label for="tel">Teléfono</label>
							<input class="form-control" type="tel" id="tel" name="telephone" placeholder="+502 0000-0000">
						</div>
					</div>
					<div class="row form-group">
						<label for="reason">Motivo</label>
						<select class="form-control" id="reason">
							<option>Selecione una opción</option>
  							<option>Colaborar</option>
  							<option>Rescate</option>
  							<option>Otro(Espicificar)</option>
+						</select>
					</div>
					<div class="row form-group">
    						<label for="description">Mensaje <span>(Opcional)</span></label>
    						<textarea class="form-control" id="description" rows="2"></textarea>
					</div>
					<div class="row form-group mb-0">
						<div class="col-md-3">
							<label for="">Contactar vía:</label>
						</div>
						<div class="col-md-9">
							<label class="radio-inline mr-4"><input type="radio" name="optradio">Correo</label>
							<label class="radio-inline"><input type="radio" name="optradio">Teléfono</label>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-success">Enviar</button>
			</div>
		</div>
	</div>
</div>


@endsection