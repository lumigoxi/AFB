@extends('dashboard.dashBase')
@section('style')
<link rel="stylesheet" href="{{ URL::asset('bower_components/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}">
@endsection
@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista de hisotiras</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Historias</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
			<div class="col">
				<hr>
				<a href="{{ route('dashboard') }}" class="btn btn-secondary  btn-sm">Regresar</a>
				<a href="#" class="btn btn-success btn-sm" id="btn-create-story" data-toggle="modal" data-target="#create-story">Crear nueva Historia</a>
        <a href="#" class="btn btn-warning btn-sm btn-edit-page" data-toggle="modal" data-target="#edit-page">Editar Página</a>
        <a href="/historias" class="btn btn-info btn-sm" target="_blank">Ver Historias</a>
				<hr>
        <table id="storyTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Creador</th>
                <th scope="col">Titulo</th>
                <th scope="col">Mascota</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha de creación</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
        @include('story.create')
        @include('story.seeStory')
        @include('story.edit')
        @include('story.add-picture')
        @include('story.pictures-gallery')
        @include('story.see-pictures')
        @include('story.edit-page')
			</div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script src="{{ URL::asset('js/moment.min.js') }}"></script>
<script src="{{ URL::asset('js/select2-lenguage.js') }}"></script>
<script>
  //FUNCIOON CARGAR TABLA
  function showTable(){
    $('#storyTable').DataTable({
      "serverSide": true,
      "ajax": "{{ url('/dashbaord/getAllStories') }}",
      "columns": [
      {data: 'userName'},
      {data: 'title'},
      {data: 'petName'},
      {data: 'status', mRender: function(data, type, row){
          if (data == '--sin publicar--') {
          return `<span class="center text-capitalize"><a href="#" class="badge badge-secondary btn-status" data-status="1" data-story="`+row.id+`">`+row.status+`</a></span>`
        }else{
          return `<span class="center text-capitalize"><a href="#" class="badge badge-success btn-status" data-status="0" data-story="`+row.id+`">`+row.status+`</a></span>`
        }
      }},
      {data: 'created_at', mRender: function(data){
         return '<p class="text-capitalize">'+moment(data).format('llll')+'</p>'
      }},
      {data: 'btn'}
      ],
      "language":{
        "info": "Mostrando _START_ al _END_ de _TOTAL_ registros",
        "search": "Buscar",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
                  },
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
                }
                            })
  }

  //CARGAMOS LA TABLA CUANDO LA PAGINA HAYA SIDO CARGADA
  $(document).ready(function() {
    showTable()
    moment.locale('es')
    $.fn.select2.defaults.set('language', 'es')


    })

$('#btn-create-story').on('click', function(e){
  e.preventDefault()
  $('#adopted').select2({
            // Activamos la opcion "Tags" del plugin
            placeholder: "Selecione una mascota",
            theme: "bootstrap",
            allowClear: true,
            ajax: {
                dataType: 'json',
                url: '{{ url("getPetStory") }}',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function (data, page) {
                  return {
                    results: data
                  }
                },
            }
        })
})


  $('#form-add-story').on('submit', function(e){
    e.preventDefault()
    let url = $(this).attr('action')
    let data = $(this).serialize()

      $.ajax({
        url: url,
        type: 'post',
        data: data,
        success: function(data){
          if (data == 1) {
            $('#create-story').modal('toggle')
            $('#storyTable').DataTable().ajax.reload()
            $('#create-story #titulo').val('')
            $('#create-story #Description').val('')
            $('#create-story #adopted').val('')
            swal({
              title: 'Exitoso',
              text: 'Se ha agregado la historia',
              icon: 'success',
              timer: 2500
            })
          }else{
            swal({
              title: 'Oops',
              text: 'Algo no salió bien',
              icon: 'info',
              timer: 25000
            })
          }
        }
      })
  })


  $('body').on('click', '#storyTable .btn-borrar', function(e){
    e.preventDefault()
    swal({
      title: '¿Seguro de eliminar esta historia?',
      text: 'Una vez eliminado no se podra revertir el cambio',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete)=>{
        if (willDelete) {
          swal ("La hisotira fue eliminada", {
            icon: 'success'
          })
          let url = $(this).parent().attr('action')
          let form = $(this).parent()

            $.post(url, form.serialize(), function(data){
              if (data == 1) {
                $('#storyTable').DataTable().ajax.reload()
                swal({
                  title: 'Exitoso',
                  text: 'Se ha eliminado correctamente',
                  icon: 'success',
                  timer: 2500
                })
              }else{
                swal({
                  title: 'Oops',
                  text: 'Algo no salió bien',
                  icon: 'info',
                  timer: 2500
                })
              }
            })
        }
    })
  })
</script>
<script>
  $('body').on('click', '#storyTable .seeStory', function(e){
  e.preventDefault()
  let idStory = $(this).attr('data-story')
  let url = '{{ route('historias.show', ':idStory') }}'.replace(':idStory', idStory)

    $.ajax({
      url: url,
      type: 'get',
      success: function(story){
        if (story != 0) {

          if (story.status == 0) {
              story.status = 'sin publicar'
              $('#status').removeClass('badge-success')
              $('#status').addClass('badge-secondary')
          }else{
            story.status = 'publicado'
            $('#status').removeClass('badge-secondary')
            $('#status').addClass('badge-success')
          }

          let created_at =  moment(story.created_at).format('llll')
          let updated_at = moment(story.request_pet.updated_at).format('ll')
          $('#storyTitle').text(story.title)
          $('#status').text(story.status)
          $('#userName').text('Creado por: '+story.user['name'])
          $('#created_at').text('Fecha de creación: '+created_at)
          $('#description').text(story.text)
          $('#nameOwner').text(story.request_pet['name'])
          $('#petName').text(story.request_pet.pet['name'])
          $('#petBreed').text(story.request_pet.pet['breed'])
          $('#dateAdopted').text(updated_at)
        }
      }
    }) 
})


$('body').on('click', '#storyTable .btn-status', function(e){
  e.preventDefault()
  let idStory = $(this).attr('data-story')
  let url = '{{ route('historias.update', ':idStory') }}'.replace(':idStory', idStory)
  let data = {
    _token: '{{ csrf_token() }}',
    status: $(this).attr('data-status'),
    type_update: 'status'
  }

    $.ajax({
      url: url,
      type: 'put',
      data: data,
      success: function(result){
        if (result == 1) {
          $('#storyTable').DataTable().ajax.reload()
          swal({
            title: 'Exitoso',
            text: 'Se ha actualizado la historia',
            icon: 'success',
            timer: 2500
          })
        }else{
          swal({
            title: 'Oops',
            text: 'Algo ha salido mal',
            icon: 'info',
            timer: 2500
          })
        }
      }
    })
})



$('body').on('click', '#storyTable .btn-editar', function(e){
  e.preventDefault()
  let idStory =  $(this).attr('data-story')
  let url = '{{ route('historias.show', ':idStory') }}'.replace(':idStory', idStory)

    $.ajax({
      url: url,
      type: 'get',
      success: function(data){
        $('#edit-story #titulo').val(data['title'])
        $('#edit-story #Description').val(data['text'])
        //$('#edit-story #edit-adopt').val(data['request_pets_id'])
        $('#form-edit-story').attr('data-story', idStory)
      }
    })
  $('#edit-adopt').select2({
            placeholder: "Selecione una mascota",
            theme: "bootstrap",
            allowClear: true,
            data: {id: 0, title: 'a ver'},
            ajax: {
                dataType: 'json',
                url: '{{ url("getPetStory") }}',
                delay: 250,
                data: function(params) {
                      return {
                        term: params.term
                      }                    
                },
                processResults: function (data, page) {
                  return {
                    results: data
                  }
                },
            },

        })
})

  $('#form-edit-story').on('submit', function(e){
  e.preventDefault()
  let idStory = $(this).attr('data-story')
  let url = '{{ route('historias.update', ':idStory') }}'.replace(':idStory', idStory)
  let data = $(this).serialize()
    $.ajax({
      url: url,
      type: 'put',
      data: data+'&type_update=all',
      success: function(data){
        $('#edit-story').modal('toggle')
        if (data == 1) {
        $('#edit-story #titulo').val('')
        $('#edit-story #Description').val('')
        $('#edit-story #edit-adopt').val('')
          swal({
          title: 'Exitoso',
          text: 'Se ha actualizado correctamente',
          icon: 'success',
          timer: 2500
        })
        }else{
          swal({
          title: 'Oops',
          text: 'Algo ha salido mal',
          icon: 'info',
          timer: 2500
        })
        }
      }
    })
})
</script>
<script>

$('body').on('click', '#storyTable .btn-add-picture', function(e){
  e.preventDefault()
  $('#modal-add-picture #form-add-picture').attr('data-story', $(this).attr('data-story'))
  $('.add-from-gallery').attr('data-pet', $(this).attr('data-pet'))
})


  $('.add-from-gallery').on('click', function(e){
    e.preventDefault()
    let idPet = $(this).attr('data-pet')
  $('#pictures-from-gallery').attr('data-pet', idPet);
  let url = '{{ route('Fotos-Mascota.show', ':idPet') }}'.replace(':idPet', idPet)
  $.ajax({
      url: url,
      data: {
        pet_id: idPet
      },
      type: 'get',
      success: function(data){
      let path = ''
      $('.carousel-inner').empty()
      $('.carousel-indicators').empty()
       for(let j = 0; j < data.length; j++) {
        path = '{{ asset('/') }}'+data[j]['path']
         $('<div class="carousel-item" data-picture="'+data[j]['id']+'"><img class="d-block w-100" src="'+path+'"></div>').appendTo('.carousel-inner');
          $('<li data-target="#carousel-example-1z" data-slide-to="'+(j)+'"></li>').appendTo('.carousel-indicators')

          }
          $('.carousel-inner > div ').first().addClass('active');
          $('.carousel-indicators > li').first().addClass('active');
          $('#carousel').carousel();
      }
       
  })
  })

$('.add-image').on('click', function(e){
  e.preventDefault()
    let image = $(this).siblings('div').children('div .active')
    let idImage = image.attr('data-picture')
    let idPet = $(this).parent().parent().parent().parent().attr('data-pet')
    let idStory = $('#form-add-picture').attr('data-story')
    $.ajax({
      type: 'post',
      data: {
        _token: '{{ csrf_token() }}',
        story_id: idStory,
        idImage: idImage,
        from: 'gallery'
      },
      url: '{{ route('historia-imagen.store') }}',
      success: function(data){
        if (data==1) {
         $('#pictures-from-gallery').modal('toggle');
          swal({
            text: 'Se ha agregado la imagen correctamente',
            icon: 'success',
            timer: 3000
          })
        }else{
          swal({
            text: data,
            icon: 'error',
            timer: 2500
          })
        }
      }
    })
})

$('#form-add-picture').on('submit', function(e){

          e.preventDefault()
          let idStory = $(this).attr('data-story')
          let data = new FormData($("#form-add-picture")[0])
          data.append('story_id', idStory)
          data.append('_token', '{{ csrf_token() }}')
          data.append('from', 'form')
            $.ajax( {
                url: '{{ route('historia-imagen.store') }}',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(data){
                   $('#modal-add-picture').modal('toggle')
                if (data==1) {
                  swal({
                    title: 'Exitiso',
                    text: 'La imagen fue subida exitosamente',
                    icon: 'success',
                    timer: 3000
                  })
                  $('#file-picture').val(null)
                }else{
                  swal({
                    title: 'Error',
                    text: data,
                    icon: 'error',
                    timer: 2500
                  })
                }
                }
            })
})
</script>
<script>
 $('body').on('click', '#storyTable .btn-see-picture', function(e){
  e.preventDefault()
  let idStory = $(this).attr('data-story')
  $('#see-pictures').attr('data-story', idStory);
  let url = '{{ route('historia-imagen.show', ':idStory') }}'.replace(':idStory', idStory)
  $.ajax({
      url: url,
      type: 'get',
      success: function(data){
       let path = ''
      $('.carousel-inner').empty()
      $('.carousel-indicators').empty()
       for(let j = 0; j < data.length; j++) {
        path = '{{ asset('/') }}'+data[j]['path']
         $('<div class="carousel-item" data-picture="'+data[j]['id']+'"><img class="d-block w-100" src="'+path+'"></div>').appendTo('#see-pictures .list-pictures');
          $('<li data-target="#carousel-all-pict" data-slide-to="'+(j)+'"></li>').appendTo('#see-pictures .control-story')

          }
          $('#see-pictures .list-pictures  div ').first().addClass('active');
          $('#see-pictures .control-story  li').first().addClass('active');
          $('#carousel-all-pict').carousel();
      }
       
  })  
})
</script>
<script>
  $('.select-image').on('click', function(e){
  e.preventDefault()
    let image = $(this).siblings('div').children('div .active')
    let idImage = image.attr('data-picture')
    let idStory = $('#see-pictures').attr('data-story')
    $.ajax({
      type: 'put',
      data: {
        _token: '{{ csrf_token() }}',
        story_id: idStory
      },
      url: '{{ route('historia-imagen.update', ':idImage') }}'.replace(':idImage', idImage),
      success: function(data){
        $('#see-pictures').modal('toggle')
        if (data==1) {
          swal({
            text: 'Se ha establecido como predeterminado',
            icon: 'success',
            timer: 3000
          })
        }else{
          swal({
            text: 'Algo ha salido mal',
            icon: 'error',
            timer: 2500
          })
        }
      }
    })
})
</script>
<script>
  $('.btn-edit-page').on('click', function(e){
    e.preventDefault()
    url = '{{ route('pages.show', ':idPage') }}'.replace(':idPage', 4)
    $.ajax({
        type: 'get',
        url: url,
        success: function(data){
          let page = document.getElementById('see-name-page')
          let description = document.getElementById('see-text-page')
          $('#see-text-page').val(data['text'])
          $('#see-title-page').val(data['title'])
          page.innerHTML = data['page']
          $('#form-edit-page').attr('data-page', data['id'])
        }
    })
})


   $('#form-edit-page').on('submit',function(e){
      e.preventDefault()
      let idPage = $(this).attr('data-page')
      let url = '{{ route('pages.update', ':idPage') }}'.replace(':idPage', idPage)
      let form = $(this).serialize()

      $.ajax({
          url: url,
          data: form,
          type: 'put',
          success: function(data){
            $('#edit-page').modal('toggle')
            if (data == 1) {
              swal({
                title: 'Exitoso',
                text: 'Se ha acutualizado al pagina',
                icon: 'success',
                timer: 3000
              })
            }else{
              swal({
                title: 'Error',
                text: 'Algo salió mal',
                icon: 'error',
                timer: 2500
              })
            }
          }
      })
  })
</script>
@endsection