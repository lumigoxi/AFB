<div class="dropdown">

	@if($status == 'Recuperado')
		<button class="btn btn-success btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Recuperado
	</button>
	@elseif($status == 'En tratamiento')
	<button class="btn btn-info btn-sm btn-block dropdown-toggle"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> En tratamiento
	</button>
	@else
	<button class="btn btn-ligth btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--Sin definir--
	</button>
	@endif
	
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" data-pet={{ $id }}>
		<a class="dropdown-item btn-status" href="#" data-status="0">Sin definir</a>
		<a class="dropdown-item btn-status" href="#" data-status="1">En tratamiento</a>
		<a class="dropdown-item btn-status" href="#" data-status="2">Recuperado</a>
	</div>
</div>