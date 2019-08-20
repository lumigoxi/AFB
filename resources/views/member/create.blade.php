<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Create Member</title>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	    <link rel="stylesheet" href="{{ URL::asset('css/utilidades.css') }}">
	    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}">
<body>
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
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>