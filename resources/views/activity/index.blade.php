@extends('dashboard.dashBase')

@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista de actividades</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Actividades</li>
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
        <div class="row">
			<div class="col">
				<hr>
				<a href="{{ route('dashboard') }}" class="btn btn-secondary  btn-sm">Regresar</a>
				<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-activity">Agregar nueva actividad</a>
        <a href="#" class="btn btn-warning btn-sm btn-edit-page" data-toggle="modal" data-target="#edit-page">Editar página</a>
        <a href="/actividades" class="btn btn-info btn-sm" target="_blank">Ver Página</a>
				<hr>
        <table id="activityTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Actividad</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
        @include('activity.create')
        @include('activity.edit')
        @include('activity.more')
        @include('activity.edit-page')
        @include('activity.add-picture')
        @include('activity.see-pictures')
			</div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script>
  //FUNCIOON CARGAR TABLA
  function showTable(){
    $('#activityTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "{{ url('actividades/getAllActivitys') }}",
      "columns": [
      {data: "id"},
      {data: 'activity'},
      {data: 'status'},
      {data: 'date'},
      {data: 'btn'}
      ],
     'order': [[0, 'desc']]
     ,
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
                            });
  }

$('#form-store-activity').on('submit', function(e){
  e.preventDefault()
  let url = $(this).attr('action')
  $.ajax({
    url: url,
    type: 'post',
    data: $(this).serialize(),
    success: function(data){
      $('#create-activity').modal('toggle')
      $ ('#activityTable').DataTable().ajax.reload();
      if (data == 1) {
        swal({
          title: 'Exitiso',
          text: 'La actividad ha sido registrada',
          icon: 'success',
          timer: 3000
        })
        $('#titulo').val('')
        $('#description').val('')
        $('#date').val('')
        $('#lugar').val('')
      }else{
        swal({
          title: 'Error',
          text: 'Algo ha salido mal',
          icon: 'error',
          timer: 2500
        })
      }
    }
  })
})

  //CARGAMOS LA TABLA CUANDO LA PAGINA HAYA SIDO CARGADA
  $(document).ready(function() {
    showTable();
    $('[data-toggle="tooltip"]').tooltip(); 
} );

  $('body').on("click", "#activityTable .seeActivity",function(e){
    e.preventDefault();
      let row = $(this).parents('tr');
      let form = $(this).parents('form');
      let url = form.attr('action');
      $.get(url, form.serialize(), function(data){
        let title = document.getElementById('seeTitle')
        let description = document.getElementById('seeDescription')
        let located_at = document.getElementById('seeLocated_at')
        title.innerHTML=data['activity']
        description.innerHTML = data['decription']
        located_at.innerHTML = data['located_at']
      })
  });


//logica para obtener una actividad
$('body').on('click', '#activityTable .btn-editar', function(e){
  e.preventDefault()
  let row = $(this).parents('tr')
  let form = $(this).parents('form')
  let url = form.attr('action')
  $.ajax({
    type: 'get',
    url: url,
    data: form.serialize,
    success: function(data){
      $('#activity').val(data.activity)
      $('#located_at').val(data.located_at)
      $('#form-edit-activity #description').val(data.decription)
      document.querySelector("#form-edit-activity #date").value = data.date
      $('#form-edit-activity').attr('data-activity', data.id)
    }
  })
})


$('#form-edit-activity').on('submit', function(e){
  e.preventDefault()
  let idActivity = $(this).attr('data-activity')
  let url = '{{ route('actividades.update', ':idActivity') }}'
  url = url.replace(':idActivity', idActivity)
  $.ajax({
    type: 'put',
    url: url,
    data: $(this).serialize()+"&type_update=all",
    success: function(data){
      $('#editModal').modal('toggle')
      if (data==1) {
        swal({
          title:'Exitoso', 
          text: 'La actividad ha sido actualizada', 
          icon: 'success',
          timer: 2500
        })
        $ ('#activityTable').DataTable().ajax.reload();
      }else{
        swal('Error', 'Algo no salió mal', 'error')
      }
    }
  })
})


$('body').on('click', '#activityTable .btn-borrar', function(e){ 
  let form = $(this).parent('form')
  let url = form.attr('action')
  e.preventDefault()
  swal({
    title: "¿Seguro de eliminar la actividad?",
    text: "Una vez eliminado no se podra revertir el cambio",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {

      $.ajax({
          url: url,
          data: form.serialize(),
          type: 'post',
          success: function(data){
              $('#activityTable').DataTable().ajax.reload();
          }
      })
      swal("La actividad fue elimnada" ,{
        icon: 'success',
        timer: 3000
      })
    }
  })
  })



$('.btn-edit-page').on('click', function(e){
    e.preventDefault()
    url = '{{ route('pages.show', ':idPage') }}'.replace(':idPage', 2)
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


 $('body').on('click', '#activityTable .btn-listar', function(e){
  e.preventDefault()
  let tag_currently = $(this)
  let status = $(this).attr('data-status')
  let idActivity = $(this).attr('data-activity')

  let url = '{{ route('actividades.update', ':idActivity') }}'.replace(':idActivity', idActivity)

    $.ajax({
        type: 'put', 
        url: url,
        data: {
          status: status,
          type_update: 'status',
          _token: '{{ csrf_token() }}'
        },
        success: function(data){
           if (data) {
                        if (status == 1) {
                            tag_currently.attr('data-status', 0)
                            tag_currently.removeClass('badge-danger')
                            tag_currently.addClass('badge-success')
                            tag_currently.text('Publicado')
                            swal("Actualizado!", "La actividad ha sido publicada", "success")
                        }else if(status == 0){
                            tag_currently.attr('data-status', 1)
                            tag_currently.removeClass('badge-success')
                            tag_currently.addClass('badge-danger')
                            tag_currently.text('Sin Publicar')
                            swal("Actualizado!", "La avtividade se ha despublicado", "success")

                        }
                    }else{
                        swal("Error", "Algo ha salido mal", "error")
                    }
        }
    })
 })

$('body').on('click', '#activityTable .btn-add-picture', function(e){
  $('#form-add-picture').attr('data-activity', $(this).attr('data-activity'))
})


$('#form-add-picture').on('submit', function(e){

          e.preventDefault()
          let idActivity = $(this).attr('data-activity')
          let data = new FormData($("#form-add-picture")[0])
          data.append('_token', '{{ csrf_token() }}')
          data.append('activity_id', idActivity)
            $.ajax( {
                url: '{{ route('imagenes.store') }}',
                type: 'post',
                data: data,
                processData: false,
                contentType: false,
                success: function(data){
                   $('#modal-add-picture').modal('toggle')
                if (data.data['uploaded']) {
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
                    text: 'No se pudo subir la imagen',
                    icon: 'error',
                    timer: 2500
                  })
                }
                }
            })
})

$('body').on('click', '#activityTable .btn-see-picture', function(e){
  e.preventDefault()
  let idActivity = $(this).attr('data-activity')
  $('#see-pictures').attr('data-activity', idActivity);
  let url = '{{ route('imagenes.show', ':idActivity') }}'.replace(':idActivity', idActivity)
  $.ajax({
      url: url,
      data: {
        activity_id: idActivity
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

$('#delete-image').on('click', function(e){
  e.preventDefault()
  let form = $(this).parent()
  let image = $(this).parent().siblings('div').children('div .active')
  let idImage = image.attr('data-picture')
  let url = '{{ route('imagenes.destroy', ':idImage') }}'.replace(':idImage', idImage)
  $.ajax({
    url: url,
    type: 'post',
    data: form.serialize(),
    success: function(data){
        if (data == 1) {
          $('#see-pictures').modal('toggle')
          swal({
            text: 'Se ha eliminado con exito',
            icon: 'success',
            timer: 3000
          })
        }else{
          swal({
            text: 'Algo salio mal',
            icon: 'error',
            timer: 2500
          })
        }
    }
  })
})

$('.select-image').on('click', function(e){
  e.preventDefault()
    let image = $(this).siblings('div').children('div .active')
    let idImage = image.attr('data-picture')
    let idActivity = $(this).parent().parent().parent().parent().attr('data-activity')
    $.ajax({
      type: 'put',
      data: {
        _token: '{{ csrf_token() }}',
        activity_id: idActivity
      },
      url: '{{ route('imagenes.update', ':idImage') }}'.replace(':idImage', idImage),
      success: function(data){
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
@endsection