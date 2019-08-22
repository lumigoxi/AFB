@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col d-flex justify-content-between">
				<h2>Listado de miembros</h2>
				<a href="{{ route('home') }}" class="btn btn-outline-secondary ">Inicio</a>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<hr>
				<a href="{{ Route('miembros.create') }}" class="btn btn-success">Crear nuevo Miembro</a>
				<hr>
				<table class="table table-striped">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nombre</th>
						<th scope="col">Apellido</th>
						<th scope="col">Role</th>
					</tr>
					@foreach($data as $info)
					<tr>
						<th scope="col">{{ $info->id }}</th>
						<td>{{ $info->name }}</td>
						<td>{{ $info->lastName }}</td>
						<td>{{ $info->idRole }}</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection
