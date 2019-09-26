{!! Form::open(['route'=>['deleteMember', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="btn-editar btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
{!! Form::close() !!}	

{!! Form::open(['route'=>['deleteMember', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="borrarMiembro btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>	
{!! Form::close() !!}	
 
 