{!! Form::open(['route'=>['historias.show', $id], 'method'=> 'GET']) !!}
<a href="#" class="btn btn-info btn-sm seeStory" data-toggle="modal" data-toggle="tooltip" title="Ver" data-placement="top" data-target="#seeStory" data-story="{{ $id }}"><i class="fa fa-eye"></i></a>
{!! Form::close() !!}	

<a href="#" class="btn-add-picture btn btn-dark btn-sm" data-toggle="modal" data-target="#modal-add-picture" data-story="{{ $id }}"><i class="fa fa-camera"></i></a>	

{!! Form::open(['route'=>['historias.update', $id], 'method'=> 'GET']) !!}
	<a href="#" class="btn-editar btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
{!! Form::close() !!}	

{!! Form::open(['route'=>['historias.destroy', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="btn-borrar btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
{!! Form::close() !!}	