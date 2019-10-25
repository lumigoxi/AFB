@extends('layouts.app')
@section('content')
<!-- main -->
<main class="carrusel">
  <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-pause="false">
    <div class="carousel-inner">
      @foreach($pictures as $index => $picture)
        <div class="carousel-item @if($index ==0) active @endif">
          <img class="d-block w-100" src="{{ asset($picture->path) }}" alt="mas perros xdxdxd">
        </div>
      @endforeach
      <div class="overlay">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-7 offset-md-5 text-center text-md-right">
              <h1>Asociación Amigo Fiel</h1>
              <h4>
              @foreach($calls as $call)
              {!! $call->call_to_action  !!}
              @endforeach
            </h4>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="hidden" name="hosted_button_id" value="ARFDLW6PR7E5Q" />
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
<img alt="" border="0" src="https://www.paypal.com/en_GT/i/scr/pixel.gif" width="1" height="1" />
</form>
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
        <span class="text-center text-uppercase h4">{{ $member->title }}</span>
        <div class="row">
          <div class="col">
            {{ $member->text }}
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