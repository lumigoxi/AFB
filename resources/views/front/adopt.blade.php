@extends('layouts.app')
@section('content')
<section id="text-info">
  <div class="container">
    <h2 class="mt-4">
      <span>{{ $page->title }}</span>
    </h2>
    <p class="mt-1 mb-5">
    <span>{{ $page->text }}</span>
  </p>
  </div>
</section>
<section id="pet-available">
	<div class="container mx-auto">
		  <div class="row">
		  	@foreach($pets as $pet)
				<div class="col-md-4">
					<div class="card">
		    <img src="{{ asset($pet->path) }}" class="card-img-top img-adopt" alt="...">
		    <div class="card-body">
		    	<span class="badge badge-pill badge-primary">{{ $pet->breed }}</span>
		    	<span class="badge badge-pill badge-danger">{{ $pet->city }}</span>
		      <h5 class="card-title">{{ $pet->name }}</h5>
		      <p class="card-text">{{ $pet->description }}</p>
		      <div class="text-center">
		      	<button class="btn btn-success bt-donar mt-3">Quiero Adoptar!</button>
		      </div>
		    </div>
		  </div>
				</div>
		  	@endforeach
		  </div>
	</div>
</section>
@endsection