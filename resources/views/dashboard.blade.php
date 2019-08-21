@extends('base')
@section('content')
<section id="Enlaces">
	<div class="container">
		<div class="row">
			<div class="col">
				<a href="{{ route('miembros.index') }}" class="btn btn-primary">Miembros</a>		
			</div>
		</div>
	</div>
</section>
@endsection
