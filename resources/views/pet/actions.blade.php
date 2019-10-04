{!! Form::open(['route'=>['Mascotas.update', $id], 'method'=> 'GET']) !!}
	<a href="#" class="btn-editar btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-pet" data-pet="{{ $id }}"><i class="fas fa-edit"></i></a>	
{!! Form::close() !!}	

{!! Form::open(['route'=>['Mascotas.destroy', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="btn-borrar btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
{!! Form::close() !!}	
