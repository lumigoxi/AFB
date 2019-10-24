@extends('dashboard.dashBase')
@section('style')
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header py-0 pt-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Contáctanos</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 py-auto">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Contáctanos</li>
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
                <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Regresar</a>
                <a href="/contactanos" class="btn  btn-info btn-sm" target="_blank">Ver Pagina</a>
                <a href="#" class="btn btn-warning btn-sm btn-edit-page" data-toggle="modal" data-target="#edit-page">Editar página</a>
                <a href="#" class="btn btn-dark btn-sm" id="btn-add-picture" data-toggle="modal"
                data-target="#modal-add-picture">Agregar Fotografía</a>
                <a href="#" class="btn btn-link btn-sm btn-pictures" data-toggle="modal"
                data-target="#delete-pictures">Eliminar Fotografía</a>
                <hr>
                               <div class="row">
                    <form class="pl-2" id="form-mission-vision">
                      <label for="h1">Título</label>
                      <div class="form-group col-md-12">
                        <textarea name="title" cols="150" rows="5" id="h1">
                        
                        </textarea>
                      </div>
                      <label for="h4">Descripción</label>
                      <div class="form-group col-md-12">
                        <textarea name="h4" cols="150" rows="5" id="h4n">
                        
                        </textarea>
                      </div>
                      <button type="submit" class="btn btn-success" id="submit-mission-vision">Actualizar</button>
                    </form>
                </div>
              
                @include('Landing.pet.edit-page')
                @include('Landing.add-picture-landing')
                @include('Landing.delete-pictures')
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
        $('.btn-edit-page').on('click', function(e){
        e.preventDefault()
        url = '{{ route('pages.show', ':idPage') }}'.replace(':idPage', 5)
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









<script>
$('#form-add-picture').on('submit', function(e){
      e.preventDefault()
          let idPet = $(this).attr('data-pet')
          let data = new FormData($("#form-add-picture")[0])
          data.append('page_id', 5)
          data.append('_token', '{{ csrf_token() }}')
            $.ajax( {
                url: '{{ route('addPageImage.store') }}',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(data){
                   $('#modal-add-picture').modal('toggle')
                if (data == 1) {
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


 $('body').on('click', '.btn-pictures', function(e){
  e.preventDefault()
  let url = '{{ route('addPageImage.show', 5) }}'
  $.ajax({
      url: url,
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
  let url = '{{ route('addPageImage.destroy', ':idImage') }}'.replace(':idImage', idImage)

  $.ajax({
    url: url,
    type: 'post',
    data: form.serialize(),
    success: function(data){
      $('#delete-pictures').modal('toggle')
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


 


 $('body').on("click", "#submitInfoContatc",function(e){
    e.preventDefault();
    let form = $(this).parents('form');
    let url = form.attr('action');
    let token = '{{csrf_token()}}'
    let textarea = CKEDITOR.instances.editor1.getData();
    let data = {text_large:textarea, _token:token};
         $.ajax({

           type:'put',

           data: data,

           url:url,


           success:function(data){
              swal("Actualizado!", "Se ha actulizado correctamente", "success");
           }

        })
  })
</script>
        @endsection