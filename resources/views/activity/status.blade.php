
	@if($status == 'Publicado')
		<div class="text-center">
                    <a href="#" class="badge badge-success btn-listar" data-activity="{{ $id }}" data-status="0">{{ $status }}</a>
          </div>
	</button>
	@elseif($status == 'Sin Publicar')
	<div class="text-center">
         <a href="#" class="badge badge-danger btn-listar" data-activity="{{ $id }}" data-status="1">{{ $status }}</a>
     </div>
	@endif

	