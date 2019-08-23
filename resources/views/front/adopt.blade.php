@extends('layouts.app')
@section('content')
<section id="text-info">
  <div class="container">
    <h2 class="mt-4">
      <span>Tú puedes cambiar la vida de ellos</span>
    </h2>
    <p class="mt-1">
    <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem quas explicabo quisquam odio laborum molestiae beatae dolore eligendi, nesciunt itaque quos expedita consequatur at corrupti natus perspiciatis, dolorem est! Dicta.</span><span>Beatae, nihil, nesciunt blanditiis pariatur provident laborum dignissimos possimus a! Eveniet, molestias. Deleniti necessitatibus tempora quis aut porro culpa at, voluptatem excepturi! Ea saepe eos similique ipsa, veritatis nesciunt rerum.</span>
  </p>
  </div>
</section>
<section id="pet-available">
	<div class="container mx-auto">
		<div class="card-deck">
		  <div class="card">
		    <img src="img\firulais-1.jpg" class="card-img-top" alt="...">
		    <div class="card-body">
		    	<span class="badge badge-pill badge-primary">Boxer</span>
		    	<span class="badge badge-pill badge-danger">Coatepeque</span>
		      <h5 class="card-title">Firulais 1</h5>
		      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
		      <div class="text-center">
		      	<button class="btn btn-success bt-donar mt-3">Quiero Adoptar!</button>
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <img src="img\firulais-2.jpg" class="card-img-top" alt="...">
		    <div class="card-body">
		    	<span class="badge badge-pill badge-primary">Husky Sibereiano</span>
		    	<span class="badge badge-pill badge-danger">San Marcos</span>
		      <h5 class="card-title">Firulais 2</h5>
		      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
		      <div class="text-center">
		    		<button class="btn btn-success bt-donar mt-3">Quiero Adoptar!</button>
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <img src="img\chilaquil.jpeg" class="card-img-top" alt="...">
		    <div class="card-body">
		    	<span class="badge badge-pill badge-primary">Chilaquil</span>
		    	<span class="badge badge-pill badge-danger">Quetzaltenango</span>
		      <h5 class="card-title">Firulais 3</h5>
		      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
			<div class="text-center">
				<button class="btn btn-success bt-donar mt-3">Quiero Adoptar!</button>
			</div>
		    </div>
		  </div>
		</div>
	</div>
</section>
@endsection