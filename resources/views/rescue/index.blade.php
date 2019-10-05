@extends('dashboard.dashBase')

@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista de rescates</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Rescates</li>
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
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#create-rescue">Registrar rescate</a>
				<hr>
        <table id="rescueTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Encargado</th>
                <th scope="col">Razon</th>
                <th scope="col">Prioridad</th>
                <th scope="col">Estado</th>
                <th scope="col">Registrado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
    @include('rescue.edit')
    @include('rescue.more')
    @include('rescue.create')
    @include('rescue.add-pet')
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
  const option_priority = `<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item btn-priority" href="#" data-priority="0">Alta</a>
                <a class="dropdown-item btn-priority" href="#" data-priority="1">Media</a>
                <a class="dropdown-item btn-priority" href="#" data-priority="2">Baja</a>
              </div>
          </div>`;
          const option_status = `<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item btn-status" data-status="0" href="#">Listo</a>
    <a class="dropdown-item btn-status" data-status="1" href="#">En curso</a>
    <a class="dropdown-item btn-status" data-status="2" href="#">Pendiente</a>
  </div>
</div>`
   //FUNCIOON CARGAR TABLA
  function showTable(){
    $('#rescueTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "{{ url('rescue/getAllRescues') }}",
      "columns": [
      {data: 'name'},
      {data: 'reason', width: '50%'},
      {data: 'priority', width: '5%', render: function(data, type, row){
        if (data == 'Alta') {
          return `<div class="dropdown">
              <button class="btn btn-danger btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  `+data+`
              </button>
              `+option_priority
        }else if(data == 'Media'){
          return `<div class="dropdown">
              <button class="btn btn-warning btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  `+data+`
              </button>
              `+option_priority
        }else if(data ==  'Baja'){
          return `<div class="dropdown">
              <button class="btn btn-secondary btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  `+data+`
              </button>
              `+option_priority
        }else{
           return `<div class="dropdown">
              <button class="btn btn-ligth btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  `+data+`
              </button>
              `+option_priority
        }
      }},
      {data: 'status', width: '5%', mRender: function(data, type, row){
        if (data == 'Listo') {
          return `<div class="dropdown">
  <button class=" btn btn-success btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    `+data+`
  </button>
  `+option_status
        }else if(data == 'Pendiente'){
          return `<div class="dropdown">
  <button class=" btn btn-danger btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    `+data+`
  </button>
  `+option_status
        }else if(data == 'En curso'){
          return `<div class="dropdown">
  <button class=" btn btn-info btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    `+data+`
  </button>
  `+option_status
        }else{
          return `<div class="dropdown">
  <button class=" btn btn-ligth btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    `+data+`
  </button>
  `+option_status
        }
      }},
      {data: 'created_at', width: '15%'},
      {data: 'btn', width: '20%', orderable: false}
      ],
      createdRow: function( row, data, dataIndex ) {
        // agregar el attr date-rescue al td de la fila
        $( row ).find('td:eq(2)')
            .attr('data-rescue', data.id)
            .addClass('asset-context box');
        $( row ).find('td:eq(3)')
            .attr('data-rescue', data.id)
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


  $('body').on('click', '#rescueTable .seeRescue', function(e){
    
    let form = $(this).parent('form')
    let resultPets = $('#result-pets').empty()
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
            $.each(data['pets'], function(key, value){
              $('#result-pets')
              .append('<p class="ml-3">'+value.name+'</p>')
            })
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

//logica camvbiar status del rescate
  $('body').on('click', '#rescueTable .btn-status', function(e){
    e.preventDefault()
    let idRescue = $(this).parent().parent().parent().attr('data-rescue')
    let url = '{{ route('rescates.update', ':idRescue') }}'.replace(':idRescue', idRescue)
    let status = $(this).attr('data-status')

    $.ajax({
        url: url,
        type: 'put',
        data: {
          status: status,
          type_update: 'status',
          _token: '{{ csrf_token() }}'
        },
        success: function(data){
          if (data == 1) {
              swal({
                title: 'Exitoso',
                text: 'Se ha actualizado',
                icon: 'success',
                timer: 3000
              })
              $ ('#rescueTable').DataTable().ajax.reload();
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
          $ ('#rescueTable').DataTable().ajax.reload();
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


  //set id rescue to new pet
  $('body').on('click', '#rescueTable .btn-add-pet', function(e){
    e.preventDefault()
    let idRescue = $(this).attr('data-rescue')
    $('#form-register-pet').attr('data-rescue', idRescue)
  })


  $('#form-register-pet').on('submit', function(e){
    e.preventDefault()
    let idRescue = $(this).attr('data-rescue')
    let data = $(this).serialize()
    let url = '{{ route('Mascotas.store') }}'

      $.ajax({
        url: url,
          type:'post',
          data: data+"&rescue_id="+idRescue+"&store_origin=rescue",
          success: function(data){
            $('#modal-add-pet').modal('toggle')
              if(data == 1){
                  swal({
                    title: 'Exitoso',
                    text: 'Se ha registrado correctamente',
                    icon: 'success',
                    timer: 3000
                  })
                $('#name').val('')
                $('#breed').val('')
                $ ('#rescueTable').DataTable().ajax.reload();
              }else{
                  swal({
                    title: 'Error',
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