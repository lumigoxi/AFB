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
          
			<div class="col">
				<hr>
				<a href="{{ route('dashboard') }}" class="btn btn-secondary ">Regresar</a>
				<hr>
        <table id="petTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Mascota</th>
                <th scope="col">Raza</th>
                <th scope="col">Albergue</th>
                <th scope="col">Estado</th>
                <th scope="col">Disponible</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
    @include('pet.see-pictures')
    @include('pet.more')
    @include('pet.edit')
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
      "processing": true,
      "serverSide": true,
      "ajax": {
            "url": "{{ url('pet/getAllPet') }}",
            "data": {
              "request_url": "tps"
            }
        },
      "columns": [
      {data: 'name', mRender: function(data){
        return `<p class="text-capitalize">`+data+`</p>`
      }},
      {data: 'breed', mRender: function(data){
        return `<p class="text-capitalize">`+(data)+`</p>`
      }},
      {data: 'located_at'},
      {data: 'statusOption'},
      {data: 'avaible', mRender: function(data){
        return `<span class="badge badge-`+(data=='disponible' ? 'info' : 'secondary')+` text-capitalize">`+data+`</span>` 
      }},
      {data: 'btn'}
      ],
      createdRow: function( row, data, dataIndex ) {
        // agregar el attr date-rescue al td de la fila
        $( row ).find('td:eq(0)')
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
        title.innerHTML=data['name'];
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
                 $('form #input-search-rescue').val(data['rescue']['reason'])
                      $('#result-rescue').val(data['rescue']['located_at']) 
                      $('#name').val(data['name'])
                      $('#breed').val(data['breed'])
                      $('#city').val(data['city'])
                      $('#located_at').val(data['located_at'])
                      $('#form-edit-pet').attr('data-pet', data['id'])
          }
      })
  })




  $('#form-edit-pet').on('submit', function(e){
    e.preventDefault()
    let idPet = $(this).attr('data-pet')
    let form = $(this)
    let url = '{{ route('Mascotas.update', ':idPet') }}'.replace(':idPet', idPet)
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
              text: data,
              icon: 'info',
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
      let form = $(this).parents('form');
      let url = form.attr('action');
      $.post(url, form.serialize(), function(data){
          $ ('#petTable').DataTable().ajax.reload()
            if (data == 1) {
              swal("Se ha eliminado exitosamente", {
                icon: "success",
                })
            }else{
              swal({
                title: 'Error',
                text: data,
                icon: 'info',
                timer: 2500
              })
            }
      })
  }
});
  })


$('body').on('click', '#petTable .btn-add-picture', function(e){
  $('#form-add-picture').attr('data-pet', $(this).attr('data-pet'))
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



//logica cambiar prioridad del rescate
  $('body').on('click', '#petTable .btn-status', function(e){
    e.preventDefault()
    let idPet = $(this).parent().attr('data-pet')
     let request_url = "{{ route('Mascotas.update', ':idPet') }}"
      request_url = request_url.replace(':idPet', idPet)
      let status = $(this).attr('data-status')
      status = parseInt(status, 10)
      $.ajax({
          url: request_url,
          type: 'put',
          data: {
            status: status,
            type_update: 'status',
            _token: '{{ csrf_token() }}'
          },
          success: function(data){
            $ ('#petTable').DataTable().ajax.reload();
            if (data == 1) {
              swal({
                title: 'Extiso',
                text: 'Se ha actualizado',
                icon: 'success',
                timer: 3000
              })
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
@endsection