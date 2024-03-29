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
		<div class="row pets-container">
		</div>
	</div>
</section>
@include('front.modals.modal-adopt')
@include('front.modals.modal-info-pet')
@section('scripts')
	<script>
		$(document).ready(function(){
			let url = '{{ url('/getAllPets') }}'
			
				$.ajax({
					url: url,
					success: function(pets){
						let container = $('.pets-container')
						let card
						if (pets != null) {
							$.each(pets, function(key, value){

 card = `<div class="col-md-4 efect-card mb-4">
				<div class="card card-adopt">
					<img src="`+value.path+`" class="card-img-top img-adopt" alt="...">
					<div class="card-body pt-1">
						<span class="badge badge-pill badge-primary mb-2">`+(value.breed == null ? '' : value.breed)+`</span>
						<span class="badge badge-pill badge-danger mb-2">`+(value.city == null ? '': value.city)+`</span>
						<h5 class="card-title text-uppercase">`+value.name+`</h5>
						<p class="card-text text-secondary">`+(value.description).slice(0,300)+`...`+`</p>
						<div class="text-center">
							<button class="btn btn-success bt-donar mt-3 requestPet" data-pet="`+value.id+`" data-toggle="modal" data-target="#modalAdopt">Quiero Adoptar!</button>
							<button class="btn btn-outline-info mt-3 seeMore" data-pet="`+value.id+`" data-toggle="modal" data-target="#info-pet">Saber mas...</button>
						</div>
					</div>
				</div>
			</div>`				

							$(card).hide().appendTo(container).fadeIn(900)	
							})
						}
					}
				})
		})


$(document).on('mouseenter', '.efect-card', function(e) {
     $(this).animate({
                marginTop: "-=1%",
            }, 200);
});

$(document).on('mouseleave', '.efect-card', function(e) {
    $(this).animate({
                marginTop: "0%"
            }, 200);  
});

$('body').on('click', '.requestPet', function(){
	$('#formAdopt').attr('data-pet', $(this).attr('data-pet'))
})
	</script>

<script>
	$('body').on('click', '.seeMore', function(e){
    e.preventDefault()
    let idPet = $(this).attr('data-pet')
     $.ajax({
            url: '{{ url('getOnePet') }}',
            type:'get',
            data: {
              pet_id: idPet
            },
            success: function(data){
              if (data != null) {                  
                    let path = ''
                    $('#pet-name').text(data[0]['name'])
                    $('#pet-description').text(data[0]['description'])
                    $('.carousel-inner').empty()
                    $('.carousel-indicators').empty()
                    let pictures = data['pictures'];
                     for(let j = 0; j < pictures.length; j++) {
                      path = '{{ asset('/') }}'+pictures[j]['path']
                       $('<div class="carousel-item" data-picture="'+pictures[j]['id']+'"><img class="d-block w-100" src="'+path+'"></div>').appendTo('.carousel-inner');
                        $('<li data-target="#carousel-story" data-slide-to="'+(j)+'"></li>').appendTo('.carousel-indicators')
                        }
                        $('.carousel-inner > div ').first().addClass('active');
                        $('#carousel-story .carousel-indicators > li').first().addClass('active');
                        $('#carousel-story').carousel();
              }
            }
          })
  })	
</script>
@endsection
@endsection