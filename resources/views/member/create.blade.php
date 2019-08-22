@extends('layouts.app')

@section('content')
	<section id="create-member">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-8 mx-auto text-center">
					<h2>Crear nuevo miembro</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-8 mx-auto">
					<form action="{{ Route('miembros.store') }}" method="post" class="px-3">
						<div class="form-group">
							@csrf
							<label for="userName">Nombre de usuario</label>
							<input class="form-control form-control-sm" type="text" name="userName" id="userName">
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
						<div class="form-group">
							<label for="role">Role</label>
							<input class="form-control form-control-sm" type="text" name="idRole" id="role">
						</div>
							<button type="submit" class="btn btn-success btn-block">Guardar</button>
							<a href="{{ route('miembros.index') }}" class="btn btn-danger btn-block">Regresar</a>
					</form>
				</div>
			</div>
		</div>
	</section>	
@endsection
