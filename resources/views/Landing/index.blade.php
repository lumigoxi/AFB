@extends('dashboard.dashBase')

@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Call to action</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Langing</li>
              <li class="breadcrumb-item active">Call to action</li>
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
			<div class="col-md-12 col-xs-12">
				<hr>
				<a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Regresar</a>                    
        <a href="{{ route('/') }}" class="btn  btn-info btn-sm" target="_blank">Ver Landing</a>
        <a href="#" class="btn btn-dark btn-sm" id="btn-add-picture" data-toggle="modal"
          data-target="#modal-add-picture">Agregar Fotografía</a>
          <a href="#" class="btn btn-link btn-sm btn-pictures" data-toggle="modal"
          data-target="#delete-pictures">Eliminar Fotografía</a>
				<hr>
        {!! Form::open(['route'=>['landing.update', 1], 'method'=> 'POST']) !!}
              <div class="form-group">  
              {!! Form::textarea('call_to_action', null, ['id' => 'editor1', 'rows' => 10, 'cols' => 80, 'class' => 'ckeditor']) !!}
              </div>
            <button type="submit" class="btn btn-success " id="submitLandig">Guardar</button>
        {!! form::close() !!} 
			</div>
		
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @include('Landing.add-picture-landing')
    @include('Landing.delete-pictures')
@endsection

@section('scripts')

<script>
        CKEDITOR.config.allowedContent = true;
</script>
<script>

  function update_ckEditor(){
    $.ajax({
      type: 'GET',
      url: '{{ route('landing.show', 1)}}',
      success: function(result){
          CKEDITOR.instances.editor1.setData(result.call_to_action);
      }
    })
  }
  $(document).ready(function(){
      update_ckEditor()
  })

  $('body').on("click", "#submitLandig",function(e){
    e.preventDefault();
    let form = $(this).parents('form');
    let url = form.attr('action');
    let token = '{{csrf_token()}}'
    let textarea = CKEDITOR.instances.editor1.getData();
    let data = {call_to_action:textarea, _token:token};
         $.ajax({

           type:'put',

           data: data,

           url:url,


           success:function(data){
              swal("Actualizado!", "El call to action fue actualizado", "success");
           }

        });
  });
</script>
<script>
  $('#form-add-picture').on('submit', function(e){
      e.preventDefault()
          let idPet = $(this).attr('data-pet')
          let data = new FormData($("#form-add-picture")[0])
          data.append('page_id', 3)
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
  let url = '{{ route('addPageImage.show', 3) }}'
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
</script>
<script>
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
</script>
@endsection