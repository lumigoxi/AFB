{!! Form::open(['route'=>['rescates.show', $id], 'method'=> 'GET']) !!}
<a href="#" class="btn btn-info btn-sm seeRescue" data-toggle="modal" data-toggle="tooltip" title="Ver" data-placement="top" data-target="#see-more-rescue" data-rescue="{{ $id }}"><i class="fa fa-eye"></i></a>
{!! Form::close() !!}	


	<a href="#" class="btn-add-pet btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add-pet" data-rescue="{{ $id }}"><i class="fa fa-paw"></i></a>	


{!! Form::open(['route'=>['rescates.update', $id], 'method'=> 'GET']) !!}
	<a href="#" class="btn-editar btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>	
{!! Form::close() !!}	

{!! Form::open(['route'=>['rescates.destroy', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="btn-borrar btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
{!! Form::close() !!}	

