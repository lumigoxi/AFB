@extends('layouts.app')

@section('content')
	<section id="login">
		<div class="container">
			<div class="row">
				<div class="col">
					<h2>Crear nuevo miembro</h2>
					<form action="{{ Route('miembros.store') }}" method="post">
						<div class="form-group">
							@csrf
							<label for="userName">Nombre de usuario</label>
							<input class="form-control" type="text" name="userName" id="userName">
						</div>
						<div class="form-group">
							<label for="name">Nombre</label>
							<input class="form-control" type="text" name="name" id="name">
						</div>
						<div class="form-group">
							<label for="lastName">Apellido</label>
							<input class="form-control" type="text" name="lastName" id="lastName">
						</div>
						<div class="form-group">
							<label for="password">Contraseña</label>
							<input class="form-control" type="password" name="password" id="password">
						</div>
						<div class="form-group">
							<label for="role">Role</label>
							<input class="form-control" type="text" name="idRole" id="role">
						</div>
							<button type="submit" class="btn btn-success btn-block">Guardar</button>
							<a href="{{ route('miembros.index') }}" class="btn btn-danger btn-block">Regresar</a>
					</form>
				</div>
			</div>
		</div>
	</section>	
@endsection
