@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<h2 class="mb-0">Listado de miembros</h2>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<hr>
				<a href="{{ route('home') }}" class="btn btn-secondary ">Regresar</a>
				<a href="{{ Route('historias.create') }}" class="btn btn-success">Crear nueva historia</a>
				<hr>
				<table class="table table-striped">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nombre del animalito</th>
						<th scope="col">Descripcion</th>
						<th scope="col">img</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
@endsection