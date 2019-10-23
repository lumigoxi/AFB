@extends('layouts.app')

@section('content')
<section id="text-info">
  <div class="container container-info">
    <h2 class="mt-4">
      <span>{{ $page->title }}</span>
    </h2>
    <p class="mt-1">
    <span>{{ $page->text }}</span>
  </p>
  </div>
</section>
  <section id="historias">
    <div class="container container-story" id="story-list">
      

    </div>
  </section>
@include('front.modals.modal-info-story')
@endsection
@section('scripts')
<script src="{{ URL::asset('js/moment.min.js') }}"></script>
  <script>
      $(document).ready(function(){
        moment.locale('es')
        $.ajax({
          url: '{{ url('getAllStory') }}',
          type: 'get',
          success: function(stories){
              if (stories != null) {
                  $.each(stories, function(key, value){
                    card = `<div class="row story-item">
                              <div class="col-md-3 col-sm-5 pt-3">
                                <img class="card-img-top" src="`+value.path+`" alt="Card image cap">
                              </div>
                              <div class="col-md-9 col-sm-7  my-4">
                                <div class="mx-auto">
                                    <h5 class="card-title text-uppercase">`+value.title+`</h5>
                                    <p class="card-text desc-pet d-inline">`+(value.text).slice(0,400)+`...</p>
                                    <div class="btn-see-more mt-3">
                                      <p class="text-secondary">By: `+value.name+`</p>
                                      <a href="#" class="btn btn-info btn-sm more-info mt-0" data-toggle="modal" data-target="#info-story" data-story="`+value.id+`">Leer mas</a>
                                    </div>
                                    <p class="text-secondary info-date">`+(moment(value.created_at).format('ll'))+`</p>
                                </div>
                              </div>
                            </div>`

                            $(card).hide().appendTo($('#story-list')).fadeIn(800)
                  })  
              }
          }
        })
      })
  </script>
  <script>

    $('body').on('click', '#story-list .more-info',function(e){
      e.preventDefault()
      let idStory = $(this).attr('data-story')
          $.ajax({
            url: '{{ url('getOneStory') }}',
            type:'get',
            data: {
              story_id: idStory
            },
            success: function(data){
              if (data != null) {                  
                    let path = ''
                    $('#story-title').text(data[0]['title'])
                    $('#story-text').text(data[0]['text'])
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
