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
        <div class="row mx-auto">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="card border-success mb-3">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="{{ asset($activity->path) }}" class="card-img img-responsive" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h3 >{{ $activity->activity }}</h3>
                  <p class="card-text">{{ $activity->decription }}</p>
                  <p class="card-text">Lugar: {{ $activity->located_at }}</p>
                  <p class="card-text">fecha: {{ $activity->date }}</p>
                  <a href="#" class="btn btn-success bt-donar" data-activity={{ $activity->id }}>saber más...</a>
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