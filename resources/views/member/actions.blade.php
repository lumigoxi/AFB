{!! Form::open(['route'=>['miembros.show', $id], 'method'=> 'GET']) !!}
<a href="#" class="btn btn-info btn-sm seeMember" data-toggle="modal" data-toggle="tooltip" title="Ver" data-placement="top" data-target="#see-more-member" data-member="{{ $id }}"><i class="fa fa-eye"></i></a>
{!! Form::close() !!}	

{!! Form::open(['route'=>['deleteMember', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="btn-editar btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
{!! Form::close() !!}	
