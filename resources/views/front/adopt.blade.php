﻿@extends('layouts.app')
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
			<div class="col-md-4 efect-card">
				<div class="card card-adopt">
					<img src="{{ asset($pet->path) }}" class="card-img-top img-adopt" alt="...">
					<div class="card-body pt-1">
						<span class="badge badge-pill badge-primary mb-2">{{ $pet->breed }}</span>
						<span class="badge badge-pill badge-danger mb-2">{{ $pet->city }}</span>
						<h5 class="card-title text-uppercase">{{ $pet->name }}</h5>
						<p class="card-text text-secondary">{{ $pet->description }}</p>
						<div class="text-center">
							<button class="btn btn-success bt-donar mt-3 requestPet" data-pet="{{ $pet->id }}" data-toggle="modal" data-target="#modalAdopt">Quiero Adoptar!</button>
							<button class="btn btn-outline-info mt-3 seeMore" data-pet="{{ $pet->id }}" data-toggle="modal">Saber mas...</button>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
@include('front.modals.modal-adopt')
@endsection