@extends('dashboard.dashBase')

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
				<a href="{{ route('dashboard') }}" class="btn btn-secondary ">Regresar</a>
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#create-rescue">Registrar Mascota</a>
				<hr>
        <table id="rescueTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Mascota</th>
                <th scope="col">Albergue</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
    @include('rescue.edit')
    @include('rescue.more')
    @include('rescue.create')
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
    $('#rescueTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "{{ url('dashboard/Mascotas/getAllPet') }}",
      "columns": [
      {data: 'DT_RowIndex', width: '5%'},
      {data: 'name'},
      {data: 'located_at'},
      {data: 'status', mRender: function(data){
        if (data == 'Disponible') {
                return `<div class="text-center">
                    <span class="badge badge-success btn-status"  data-status="1">`+data+`</span>
                </div>`;
            }else{
                return `<div class="text-center">
                    <span class="badge badge-info btn-status" data-status="0">`+data+`</span>
                </div>`;
            }
      }},
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

  //CARGAMOS LA TABLA CUANDO LA PAGINA HAYA SIDO CARGADA
  $(document).ready(function() {
    showTable();
    $('[data-toggle="tooltip"]').tooltip(); 
    
} );


  $('body').on('click', '#rescueTable .seePet', function(e){
    
    let form = $(this).parent('form')
    $.ajax({
      url: form.attr('action'),
      type: 'get',
      data: form.serialize(),
      success: function(data){
        let title = document.getElementById('see-reason-rescue');
        let description = document.getElementById('see-description-rescue');
        let located_at = document.getElementById('see-located_at-rescue');
        title.innerHTML=data['reason'];
        let user = document.getElementById('see-user-rescue')
        description.innerHTML = data['description'];
        located_at.innerHTML = data['located_at']
        if (data['user']) {
            user.innerHTML= data['user']['name']
        }else{
            user.innerHTML = '--Sin encargado--'
        }
      }
    })
  })


//logica cambiar prioridad del rescate
  $('body').on('click', '#rescueTable .btn-priority', function(e){
    e.preventDefault()
    let idRescue = $(this).parent().parent().parent().attr('data-rescue')
     let request_url = "{{ route('rescates.update', ':idRescue') }}"
      request_url = request_url.replace(':idRescue', idRescue)
      let priority = $(this).attr('data-priority')

      $.ajax({
          url: request_url,
          type: 'put',
          data: {
            priority: priority,
            type_update: 'priority',
            _token: '{{ csrf_token() }}'
          },
          success: function(data){
            if (data == 1) {
              swal({
                title: 'Extiso',
                text: 'Se ha actualizado',
                icon: 'success',
                timer: 3000
              })
              $ ('#rescueTable').DataTable().ajax.reload();
            }else{
              swal({
                title: 'Error',
                text: 'Algo no ha salido bien',
                icon: 'error',
                timer: 2500
              })
            }          
          }
      })
  })



  $('body').on('click', '#rescueTable .btn-editar', function(e){
    e.preventDefault()
    let form = $('#form-edit-rescue')
    let url = $(this).parent('form').attr('action')

      $.ajax({
          url: url,
          type: 'get',
          success: function(data){
              if (data['user_id'] == 0) {
                form.children('div').children('div').children('#input-search-user').attr('placeholder', 'Ingrese encargado')
                 $('#input-search-user').val('')
                      $('#name').val('') 
                      $('#email').val('')
                      $('#reason').val(data['reason'])
                      $('#description').val(data['description'])
                      $('#located_at').val(data['located_at'])  
                      $('#form-edit-rescue').attr('data-rescue', data['id'])
                      $('#form-edit-rescue').attr('data-user', 0)

              }else{
                 $('#input-search-user').val(data['user']['name'])
                      $('#name').val(data['user']['name']) 
                      $('#email').val(data['user']['email'])
                      $('#reason').val(data['reason'])
                      $('#description').val(data['description'])
                      $('#located_at').val(data['located_at'])  
                      $('#form-edit-rescue').attr('data-rescue', data['id'])
                      $('#form-edit-rescue').attr('data-user', data['user']['id'])

              }
          }
      })
  })

  $('#input-search-user').focusout(function(e){

      let user = $(this).val()
      let url = '{{ route('rescates.edit', ':Rescue') }}'.replace(':Rescue', user)

      $.ajax({
          url: url,
          type: 'get',
          data: {
            user: user
          },
          success: function(data){
            if (data[0]) {
              $('#name').val(data[0]['name']) 
            $('#email').val(data[0]['email'])  
            $('#form-edit-rescue').attr('data-user', data[0]['id'])
          }else{
               $('#name').val('--No existe--') 
            $('#email').val('--No existe--')
            $('#form-edit-rescue').attr('data-user', 'empty')   
          }
          }
      })
  })

  $('#form-edit-rescue').on('submit', function(e){
    e.preventDefault()
    let idRescue = $(this).attr('data-rescue')
    let form = $(this)
    let idUser = $(this).attr('data-user')
    let url = '{{ route('rescates.update', ':idRescue') }}'.replace(':idRescue', idRescue)
    console.log(url)
    $.ajax({
        url: url,
        type: 'put',
        data: form.serialize()+"&type_update=all+&user_id="+idUser,
        success: function(data){
          $('#editModal').modal('toggle')
          if (data == 1) {
            swal({
              title: 'Exito',
              text: 'Se ha actualizado',
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

  $('body').on('click', '#rescueTable .btn-borrar', function(e){
      e.preventDefault()
       swal({
  title: "¿Seguro de eliminar el rescate?",
  text: "Una vez eliminado no se podra revertir el cambio",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("El rescate se ha eliminado exitosamente", {
      icon: "success",
    });
      let form = $(this).parents('form');
      let url = form.attr('action');
      $.post(url, form.serialize(), function(){
          $ ('#rescueTable').DataTable().ajax.reload();
      })
  }
});
  })


  $('#form-create-rescue').on('submit', function(e){
      e.preventDefault()
      let form = $(this)

      $.ajax({
        url: '{{ route('rescates.store') }}',
        type: 'post',
        data: form.serialize(),
        success: function(data){
          $('#create-rescue').modal('toggle')
          if (data == 1) {
            $('#rescueTable').DataTable().ajax.reload();
            swal({
              title: 'Exitiso',
              text: 'Se ha creado con exito',
              icon: 'success',
              timer: 3000
            })
            $('form #reason').val('')
            $('form #description').val('')
            $('form #located_at').val('')
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