@extends('dashboard.dashBase')
@section('style')
@endsection
@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mascotas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Mascotas</li>
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
          <div class="container">
		<div class="row">
			<div class="col">
				<hr>
				<a href="{{ route('dashboard') }}" class="btn btn-secondary  btn-sm">Regresar</a>
        <a href="#" class="btn btn-warning btn-sm btn-edit-page" data-toggle="modal" data-target="#edit-page">Editar página</a>
        <a href="/adoptar" class="btn btn-info btn-sm" target="_blank">Ver página</a>
				<hr>
        <table id="petTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
              <th scope="col">#</th>
                <th scope="col">Mascota</th>
                <th scope="col">Raza</th>
                <th scope="col">Albergue</th>
                <th scope="col">Publicar</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
    @include('Landing.pet.more')
    @include('pet.add-picture')
    @include('Landing.pet.edit')
    @include('Landing.pet.edit-page')
			</div>
		</div>
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
    $('#petTable').DataTable({
      "serverSide": true,
       "ajax": {
            "url": "{{ url('pet/getAllPet') }}",
            "data": {
              "request_url": "cms"
            }
        },
      "columns": [
      {data: 'DT_RowIndex'},
      {data: 'name'},
      {data: 'breed'},
      {data: 'located_at'},
      {data: 'visible', mRender: function(data){
        if (data == 'Publicado') {
                return `<div class="text-center">
                    <a href="#" class="badge badge-success btn-listar"  data-visible="1">`+data+`</a>
                </div>`;
            }else{
                return `<div class="text-center">
                    <a href="#" class="badge badge-danger btn-listar" data-visible="0">`+data+`</a>
                </div>`;
            }
      }},
      {data: 'btn'}
      ],
      createdRow: function( row, data, dataIndex ) {
        // agregar el attr date-rescue al td de la fila
        $( row ).find('td:eq(4)')
            .attr('data-pet', data.id)
            .addClass('asset-context box');
    },
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

  //CARGAMOS LA TABLA CUANDO LA PAGINA HAYA SIDO CARGADA
  $(document).ready(function() {
    showTable();
    $('[data-toggle="tooltip"]').tooltip(); 
    
} );


  $('body').on('click', '#petTable .seePet', function(e){
    
    let form = $(this).parent('form')
    $.ajax({
      url: form.attr('action'),
      type: 'get',
      data: form.serialize(),
      success: function(data){
        let title = document.getElementById('see-name-pet');
        let description = document.getElementById('see-description-pet');
        title.innerHTML=data['name'];
        description.innerHTML = data['description'];
      }
    })
  })





  $('body').on('click', '#petTable .btn-editar', function(e){
    e.preventDefault()
    let form = $('#form-edit-pet')
    let url = $(this).parent('form').attr('action')
      $.ajax({
          url: url,
          type: 'get',
          success: function(data){
                 $('form #input-search-pet').val(data['name'])
                      $('#description').val(data['description'])
                      $('#form-edit-pet').attr('data-pet', data['id'])
          }
      })
  })




  $('#form-edit-pet').on('submit', function(e){
    e.preventDefault()
    let idPet = $(this).attr('data-pet')
    let form = $(this)
    let url = '{{ route('cms-mascotas.update', ':idPet') }}'.replace(':idPet', idPet)
    $.ajax({
        url: url,
        type: 'put',
        data: form.serialize()+"&type_update=all",
        success: function(data){
          $('#modal-edit-pet').modal('toggle')
          if (data == 1) {
            swal({
              title: 'Exito',
              text: 'Se ha actualizado',
              icon: 'success',
              timer: 3000
            })
            $ ('#petTable').DataTable().ajax.reload()
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



  $('body').on('click', '#petTable .btn-borrar', function(e){
      e.preventDefault()
       swal({
  title: "¿Seguro de eliminar la mascota?",
  text: "Una vez eliminado no se podra revertir el cambio",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Se ha eliminado exitosamente", {
      icon: "success",
    });
      let form = $(this).parents('form');
      let url = form.attr('action');
      $.post(url, form.serialize(), function(){
          $ ('#petTable').DataTable().ajax.reload();
      })
  }
});
  })


$('body').on('click', '#petTable .btn-add-picture', function(e){
  $('#form-add-picture').attr('data-pet', $(this).attr('data-pet'))
})





$('body').on('click', '#petTable .btn-listar', function(e){
    e.preventDefault()
    let tag_currently = $(this)
    let current_visible = $(this).attr('data-visible')
    let idPet = $(this).parent().parent().attr('data-pet')

    let url = '{{ route('cms-mascotas.update', ':idPet') }}'.replace(':idPet', idPet)
    let data = {
      visible: current_visible,
      _token: '{{ csrf_token() }}',
      type_update: 'visible'
    }

    $.ajax({
        url: url,
        type: 'put',
        data: data,
        success: function(data){
            if (data == 1) {
              if (current_visible == 0) {
                 tag_currently.attr('data-visible', 1)
                  tag_currently.removeClass('badge-danger')
                  tag_currently.addClass('badge-success')
                  tag_currently.text('Publicado')
                  swal("Actualizado!", "La mascota ha sido publicada", "success")
              }else{
                tag_currently.attr('data-visible', 0)
                tag_currently.removeClass('badge-success')
                tag_currently.addClass('badge-danger')
                tag_currently.text('No publicado')
                swal("Actualizado!", "Se ha despublicado la mascota", "success")
              }
            }else{
              swal("Error", "Algo salió mal", "error")
            }
        }
    })

})


$('#form-add-picture').on('submit', function(e){

          e.preventDefault()
          let idPet = $(this).attr('data-pet')
          let data = new FormData($("#form-add-picture")[0])
          data.append('pet_id', idPet)
          data.append('_token', '{{ csrf_token() }}')
            $.ajax( {
                url: '{{ route('Fotos-Mascota.store') }}',
                type: 'POST',
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



$('.btn-edit-page').on('click', function(e){
    e.preventDefault()
    url = '{{ route('pages.show', ':idPage') }}'.replace(':idPage', 1)
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