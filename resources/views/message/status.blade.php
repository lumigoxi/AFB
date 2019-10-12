@if($status == 'Pendiente')
{!! Form::open(['route'=>['Mensajes.update', $id], 'method'=> 'put']) !!}
<div class="text-center">
	<a href="#" class="badge badge-danger btn-status"  data-status="1">{{ $status }}</a>
</div>
{!! Form::close() !!}	
@else
{!! Form::open(['route'=>['Mensajes.update', $id], 'method'=> 'put']) !!}
<div class="text-center">
	<a href="#" class="badge badge-info btn-status"  data-status="0">{{ $status }}</a>
</div>
{!! Form::close() !!}	
@endif
