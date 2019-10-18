@extends('layouts.app')

@section('content')
<section id="text-info">
  <div class="container">
    <h2 class="mt-4">
      <span>Historias Destacadas</span>
    </h2>
    <p class="mt-1">
    <span>Amigo Fiel hace todo lo posible para cambiar la vida de las animales recatados, desde el rescate, la recuperacion y tratamiento que este necesite, posteriormente buscarrle una nueva familia que se haga cargo de el, no solo se trata de buscarle una failia, sino un lugar donde sea amado y que sean responsables de el.</span>
  </p>
  </div>
</section>
  <section id="historias">
    <div class="container">
      <div class="row">
         <div class="col-md-3">
            <img class="card-img-top" src="img\firulais-1.jpg" alt="Card image cap">
        </div>
        <div class="col-md-9">
          <div class="card ml-auto mr-auto">
            <div class="card-body">
              <h5 class="card-title text-uppercase">Jorgito</h5>
              <p class="card-text desc-pet">Rescatado de un vecindario en la zona 3, al inicio no podia cambianar, pero AMIGO FIEL hizo todo lo posible para cambiarle la vida, se le dio el tratamiento adecuando y ahora disfruta una vida feliz con su nueva familia en La esperenza Quetzaltenango</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
         <div class="col-md-3">
            <img class="card-img-top" src="img\firulais-2.jpg" alt="Card image cap">
        </div>
        <div class="col-md-9">
          <div class="card ml-auto mr-auto">
            <div class="card-body">
              <h5 class="card-title text-uppercase">Memita</h5>
              <p class="card-text desc-pet">Fue abandonada desde que era un cachorro, se le encontro en la orilla de la carretera pidiendo a ladridos que la rescataran, desde una  larga lucha para combatir la desnuticion que padecia, ahora es super feliz con su propietaria, mas que ser eso, es su amiga inseparable.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
         <div class="col-md-3">
            <img class="card-img-top" src="img\firulais-3.jpg" alt="Card image cap">
        </div>
        <div class="col-md-9">
          <div class="card ml-auto mr-auto">
            <div class="card-body">
              <h5 class="card-title text-uppercase">Pantera</h5>
              <p class="card-text">Es un hermoso perrrito, cariñoso y docil, tuvo un vida un triste, porque lo usuaban como guardia de un taller mecanico, sufria de abusos por parte de su antiguo dueño, su rescate fue muy dificil pero al final el dueño entendio que no era un guardian, el es un ser vivo, necesita  jugar, diversitise, sentirse amado por una familia que lo quiera, ahora se divirte todo los dias con su niño de 13 añitos</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

@endsection
