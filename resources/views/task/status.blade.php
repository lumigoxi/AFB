@if($pets > 0)
	<button class="btn btn-success btn-sm btn-block">Listo</button>
@else
<div class="dropdown">
	<button class=" btn 
	@if($status == 'Listo') 
		btn-success
	@elseif($status == 'Pendiente')
		btn-danger
	@else
		btn-warning
	@endif btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $status }}</button>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" data-rescue="{{ $id }}">
		<a class="dropdown-item btn-status" data-status="0" href="#">Listo</a>
		<a class="dropdown-item btn-status" data-status="1" href="#">En curso</a>
		<a class="dropdown-item btn-status" data-status="2" href="#">Pendiente</a>
	</div>
</div>
@endif