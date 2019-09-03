<a href="#" class="btn btn-info btn-sm seeActivity" data-id="{{ $id }}"data-toggle="modal" data-target="#see-more-activity"><i class="fa fa-eye"></i></a>

{!! Form::open(['route'=>['actividades.destroy', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="borrarMiembro btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
{!! Form::close() !!}	

{!! Form::open(['route'=>['actividades.destroy', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="btn-editr btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>	
{!! Form::close() !!}	

