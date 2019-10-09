@extends('layouts.app')
@section('content')
<section id="text-info">
  <div class="container">
    <h2 class="mt-4">
      <span>{{ $page->title }}</span>
    </h2>
    <p class="mt-1">
    <span>{{ $page->text }}</span>
  </p>
  </div>
</section>
<section id="actividades">
    <div class="container mt-5">
      
      @foreach ($activities as $activity)
        <div class="row">
        <div class="col-md-12">
          <div class="card border-success mb-3">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="{{ asset($activity->path) }}" class="card-img img-responsive" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ $activity->activity }}</h5>
                  <p class="card-text">{{ $activity->decription }}</p>
                  <p class="card-text">Lugar: lugar x</p>
                  <p class="card-text">fecha: {{ $activity->date }}</p>
                  <p class="card-text">Cactegoria: Categoria de la actividad </p>
                  <a href="#" class="btn btn-success bt-donar">saber más...</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
      @endforeach
          
    </div>
  </section>

@endsection