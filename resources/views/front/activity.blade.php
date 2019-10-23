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
    <div class="container mt-5" id="activity-list">
      
      {{-- @foreach ($activities as $activity)
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
      @endforeach --}}
          
    </div>
  </section>
@include('front.modals.modal-info-activity')
@endsection

@section('scripts')
<script src="{{ URL::asset('js/moment.min.js') }}"></script>
  <script>
    $(document).ready(function(){
      moment.locale('es')
        $.ajax({
          url: '{{ url('getAllActivities') }}',
          type: 'get',
          success: function(activities){
              if (activities != null) {
                  $.each(activities, function(key, value){
                    card = `<div class="row mx-auto">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="card border-success mb-3">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="`+value.path+`" class="card-img img-responsive" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h3 >`+value.activity+`</h3>
                  <p class="card-text">`+(value.decription.slice(0,400))+`...</p>
                  <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <p class="card-text mb-0">Lugar: `+value.located_at+`</p>
                      <p class="card-text mb-0">Fecha: `+(moment(value.date).format('ll'))+`</p>
                      <p class="card-text">Hora: `+moment(value.date).format('h:mm a')+`</p>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12" style="display: flex; align-items: flex-end; ">
                        <a href="#" data-toggle="modal" data-target="#info-activity" class="btn btn-info btn-sm seeMore" data-activity=`+value.id+`>saber más...</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  `

                            $(card).hide().appendTo($('#activity-list')).fadeIn(800)
                  })  
              }
          }
        })
    })
  </script>
  <script>
    
    $('body').on('click', '.seeMore', function(e){
      e.preventDefault()
      let idActivity = $(this).attr('data-activity')
          $.ajax({
            url: '{{ url('getOneActivity') }}',
            type:'get',
            data: {
              activity_id: idActivity
            },
            success: function(data){
              if (data != null) {                  
                    let path = ''
                    $('#story-title').text(data[0]['activity'])
                    $('#story-text').text(data[0]['decription'])
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