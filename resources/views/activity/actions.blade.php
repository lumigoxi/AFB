{!! Form::open(['route'=>['actividades.show', $id], 'method'=> 'GET']) !!}
<a href="#" class="btn btn-info btn-sm seeActivity" data-toggle="modal" data-toggle="tooltip" title="Ver" data-placement="top" data-target="#see-more-activity"><i class="fa fa-eye"></i></a>
{!! Form::close() !!}	

<a href="#" class="btn-add-picture btn btn-dark btn-sm" data-toggle="modal" data-target="#modal-add-picture" data-activity="{{ $id }}"><i class="fa fa-camera"></i></a>	

{!! Form::open(['route'=>['actividades.show', $id], 'method'=> 'GET']) !!}
	<a href="#" class="btn-editar btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>	
{!! Form::close() !!}	

{!! Form::open(['route'=>['actividades.destroy', $id], 'method'=> 'DELETE']) !!}
	<a href="#" class="btn-borrar btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
{!! Form::close() !!}	

<a href="#" class="btn-see-picture btn btn-link btn-sm" data-toggle="modal" data-activity="{{ $id }}"data-target="#see-pictures" data-activity="{{ $id }}"><i class="fa fa-camera"></i></a>	
