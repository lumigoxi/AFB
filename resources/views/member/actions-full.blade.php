{!! Form::open(['route'=>['deleteMember', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="borrarMiembro btn btn-danger btn-sm" data-member="{{ $id }}"><i class="fa fa-trash"></i></a>	
{!! Form::close() !!}	
 
 