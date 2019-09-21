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
              <p class="card-text">Rescatar y brindar una mejor calidad de vida para todos los animalitos callejores de Quetzaltengo, creemos que la mejor forma de lograr eso es concientizar a las personas para esterilizar a sus mascotas y reducir la sobre poblacion de ellas.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 text-center">
          <div class="card ml-auto mr-auto">
            <div class="card-body">
              <h5 class="card-title text-uppercase">visión</h5>
              <p class="card-text">Expandirnos a nivel nacional, ser una asociacion fuerte y concisa, armarnos de mas y mas colaboradores para crecer estructuralemente y administrativamente para asi lograr tener un alcance mas amplio y ayudar mas peluditos que lo necesitan.</p>
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
        <div class="col-md-4">
          <div class="card ml-auto mr-auto">
            
            <div class="card-body">
              <h5 class="card-title text-uppercase">Greysi Martinez</h5>
              <p class="card-text">Representante legal de la organizacione, he trabajado desde el año 2008 por el mejoramiento de la calidad de vida de los animales recatados.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card ml-auto mr-auto">
              
            <div class="card-body">
              <h5 class="card-title text-uppercase">Aaron Gonzales</h5>
              <p class="card-text">De los miembros mas antiguos de la asociacion, juntos con los demas miebros nos encargamos de rescatar a los animales que lo necesitan, velando por recuperacion y reintegracion a una nueva familia.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card ml-auto mr-auto">
             
            <div class="card-body">
              <h5 class="card-title text-uppercase">Miguel Xiap</h5>
              <p class="card-text">Joven estudiante de la Universidad Mariano Galvez, he ayudado desde marzo del 2019 en el desarrollo de esta plataforma.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
