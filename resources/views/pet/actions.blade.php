{!! Form::open(['route'=>['Mascotas.show', $id], 'method'=> 'GET']) !!}
<a href="#" class="btn btn-info btn-sm seePet" data-toggle="modal" data-toggle="tooltip" title="Ver" data-placement="top" data-target="#see-more-pet" data-pet="{{ $id }}"><i class="fa fa-eye"></i></a>
{!! Form::close() !!}	



@if($avaible == 'disponible')
	{!! Form::open(['route'=>['Mascotas.update', $id], 'method'=> 'put']) !!}
	<a href="#" class="btn-editar btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-pet" data-pet="{{ $id }}"><i class="fas fa-edit"></i></a>	
	{!! Form::close() !!}

	
{!! Form::open(['route'=>['Mascotas.destroy', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="btn-borrar btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
{!! Form::close() !!}		
@endif

