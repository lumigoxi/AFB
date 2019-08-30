{!! Form::open(['route'=>['deleteMember', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="borrarMiembro btn btn-danger btn-sm">Borrar</a>
{!! Form::close() !!}	

{!! Form::open(['route'=>['deleteMember', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="btn-editr btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">Editar</a>	
{!! Form::close() !!}	

