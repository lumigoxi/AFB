@extends('layouts.app')

@section('content')
	<section id="create-member">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-8 mx-auto text-center">
					<h3>Crear nuevo miembro</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-8 mx-auto">
					<form action="{{ Route('historias.store') }}" method="post" class="px-3">
						@csrf
						<div class="row">
						<div class="col-md-7 col-sm-12">
							<label for="userName">Nombre de usuario</label>
							<input class="form-control form-control-sm" type="text" name="userName" id="userName">
						</div>
						<div class="col-md-5 col-sm-12">
							<label for="role">Role</label>
							<input class="form-control form-control-sm" type="number" name="idRole" id="role">
						</div>

						</div>
						<div class="form-group">
							<label for="name">Nombre</label>
							<input class="form-control form-control-sm" type="text" name="name" id="name">
						</div>
						<div class="form-group">
							<label for="lastName">Apellido</label>
							<input class="form-control form-control-sm" type="text" name="lastName" id="lastName">
						</div>
						<div class="form-group">
							<label for="password">Contraseña</label>
							<input class="form-control form-control-sm" type="password" name="password" id="password">
						</div>
							<button type="submit" class="btn btn-success btn-block">Guardar</button>
							<a href="{{ route('miembros.index') }}" class="btn btn-danger btn-block">Regresar</a>
					</form>
				</div>
			</div>
		</div>
	</section>	
@endsection
