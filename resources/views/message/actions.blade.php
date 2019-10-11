{!! Form::open(['route'=>['Mensajes.show', $id], 'method'=> 'GET']) !!}
<a href="#" class="btn btn-info btn-sm seePet" data-toggle="modal" data-toggle="tooltip" title="Ver" data-placement="top" data-target="#see-more-info" data-message="{{ $id }}"><i class="fa fa-eye"></i></a>
{!! Form::close() !!}	



{!! Form::open(['route'=>['Mensajes.destroy', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="btn-borrar btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
{!! Form::close() !!}	
