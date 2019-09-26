@extends('layouts.app')

@section('content')
      <!-- main -->
  <main class="carrusel">
    <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-pause="false">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img\carrusel-1.jpg" alt="un perro xd">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img\carrusel-2.jpg" alt="otro perro xd">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img\carrusel-3.jpg" alt="mas perros xdxdxd">
    </div>
    <div class="overlay">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-7 offset-md-5 text-center text-md-right">
            <h1>Asociación Amigo Fiel</h1>
            <h4>
             @foreach($calls as $call)
               {!! $call->call_to_action  !!} 
             @endforeach
            <button class="btn-success btn-donar" type="button">Donar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  </main>
  <!-- /main -->

<section id="cards">
    <div class="container">
      <div class="row">
        <div class=" col-md-6 col-sm-12 text-center">
          <div class="card ml-auto mr-auto">
            <div class="card-body">
              <h5 class="card-title text-uppercase">misión</h5>
              <p class="card-text">{{ $calls[0]['mission']}}</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 text-center">
          <div class="card ml-auto mr-auto">
            <div class="card-body">
              <h5 class="card-title text-uppercase">visión</h5>
              <p class="card-text">{{ $calls[0]['vision'] }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section id="colaboradores">
    <div class="container mt-5">
      <div class="row text-center titulo-colaboradores">
        <div class="col">
              <span class="text-center text-uppercase h4">colaboradores</span>

              <div class="row">
                <div class="col">
                  Los colaboradores son un grupo de personas interesadas por el probienestar de los animales, estas son personas quienes dia con dia trabajan para rescatar y velar por la recuperacion de los peluditos.
                </div>
              </div>
        </div>
      </div>
      <div class="row text-center">
       
        @foreach($users as $user)
          <div class="col-md-4">
          <div class="card ml-auto mr-auto">
             
            <div class="card-body">
              <h5 class="card-title text-uppercase">{{ $user->name }}</h5>
              <p class="card-text pt-2">{{ $user->description }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
