@extends('dashboard.dashBase')

@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista de miembros</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Miembros</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="container">
		<div class="row">
			<div class="col">
				<hr>
				<a href="{{ route('dashboard') }}" class="btn btn-secondary ">Regresar</a>
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#create-user">Crear nuevo Miembro</a>
				<hr>
				<table class="table table-striped table-responsive">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nombre</th>
						<th scope="col">Correo</th>
            <th scope="col">Fecha de creación</th>
            <th scope="col" class="text-center accion">Acciones</th>
					</tr>
					@foreach($data as $info)
					<tr>
						<th scope="col">{{ $info->id }}</th>
						<td>{{ $info->name }}</td>
						<td>{{ $info->email }}</td>
            <td class="text-center">{{ date('d-m-y', strtotime($info->created_at))}}</td>
            <td class="d-flex justify-content-between">
              <a href="#" data-target="{{$info->id}}" class="btn btn-warning">Editar</a>
              <a href="#" data-target="{{$info->id}}" class="btn btn-danger">Borrar</a>
            </td>
					</tr>
					@endforeach
				</table>
        @include('member.create')
			</div>
		</div>
	</div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
