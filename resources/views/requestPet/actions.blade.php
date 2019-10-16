
{!! Form::open(['route'=>['Solicitudes.show', $id], 'method'=> 'GET']) !!}
<a href="#" class="btn btn-info btn-sm seeRequest" data-toggle="modal" data-toggle="tooltip" title="Ver" data-placement="top" data-target="#seeRequest" data-request="{{ $id }}"><i class="fa fa-eye"></i></a>
{!! Form::close() !!}	

@if($status != 'aprobado' )
{!! Form::open(['route'=>['Solicitudes.destroy', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="btn-borrar btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
{!! Form::close() !!}	
@endif