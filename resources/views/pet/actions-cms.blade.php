{!! Form::open(['route'=>['Mascotas.show', $id], 'method'=> 'GET']) !!}
<a href="#" class="btn btn-info btn-sm seePet" data-toggle="modal" data-toggle="tooltip" title="Ver" data-placement="top" data-target="#see-more-pet" data-pet="{{ $id }}"><i class="fa fa-eye"></i></a>
{!! Form::close() !!}	

		<a href="#" class="btn-add-picture btn btn-dark btn-sm" data-toggle="modal" data-target="#modal-add-picture" data-pet="{{ $id }}"><i class="fa fa-camera"></i></a>	


{!! Form::open(['route'=>['Mascotas.update', $id], 'method'=> 'put']) !!}
	<a href="#" class="btn-editar btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-pet" data-pet="{{ $id }}"><i class="fas fa-edit"></i></a>	
{!! Form::close() !!}	



<a href="#" class="btn-see-picture btn btn-link btn-sm" data-toggle="modal" data-pet="{{ $id }}"data-target="#see-pictures" data-pet="{{ $id }}"><i class="fa fa-camera"></i></a>	
