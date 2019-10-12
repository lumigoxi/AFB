@extends('dashboard.dashBase')

@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista de tareas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">tareas</li>
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
				<hr>
        <table id="taskTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Rescate</th>
                <th scope="col">Estado</th>
                <th scope="col">Prioridad</th>
                <th scope="col">Registrado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
    @include('task.more')
    @include('task.add-pet')
    @include('task.add-note')
			</div>
		
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script src="{{ URL::asset('js/moment.min.js') }}"></script>
<script>

   //FUNCIOON CARGAR TABLA
  function showTable(){
    $('#taskTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "{{ url('dashboard/tasks/getMyTasks') }}",
      "columns": [
      {data: 'DT_RowIndex', width: '5%'},
      {data: 'reason', width: '40%', mRender:function(data) {
        return '<p class="text-capitalize">'+data+'</p>'
      }},
      {data: 'btn-status', width: '15%'},
      {data: 'priority', width: '5%',mRender: function(data){
          if (data == 'Alta') {
            return `<div class="text-center">
                  <span class="badge badge-danger btn-block">`+data+`</span>
            </div>`
          }else if(data == 'Media'){
            return `<div class="text-center">
                  <span class="badge badge-warning btn-block">`+data+`</span>
            </div>`
          }else{
            return `<div class="text-center">
                  <span class="badge badge-secondary btn-block">`+data+`</span>
            </div>`
          }
      }},
      {data: 'created_at', width: '15%', mRender: function(data){
        return '<p class="text-capitalize">'+moment(data).fromNow()+'</p>'
      }},
      {data: 'btn', width: '15%'}
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
                            })
  }

  //CARGAMOS LA TABLA CUANDO LA PAGINA HAYA SIDO CARGADA
  $(document).ready(function() {
    showTable()
    moment.locale('es')
})


 $('body').on('click', '#taskTable .seeRescue', function(e){
    
    let rescueId = $(this).attr('data-rescue')
    let url = '{{ route('Tareas.show', ':RescueId') }}'.replace(':RescueId', rescueId)
    let resultPets = $('#result-pets').empty()
    $.ajax({
      url: url,
      type: 'get',
      success: function(data){
        $('#see-reason-rescue').text(data['reason']);
        $('#see-description-rescue').text(data['description'])
        $('#see-located_at-rescue').text(data['located_at'])
        $('#seeNote').text(data['note'])
          if (data['pets'] != null) {
            $.each(data['pets'], function(key, value){
              $('#result-pets')
              .append('<p><span class="ml-3">'+value.name+'</span></p>')
            })
           }else{
            resultPets.text('--Sin definir--')
           }
      }
    })
  })

 $('body').on('click', '#taskTable .btn-status', function(e){
    e.preventDefault()
    let status = $(this).attr('data-status')
    let idRescue = $(this).parent('div').attr('data-rescue')
    let url = '{{ route('Tareas.update', ':idRescue') }}'.replace(':idRescue', idRescue)
      $.ajax({
        url: url,
        type: 'put',
        data: {
          status: status,
          _token: '{{ csrf_token() }}',
          type_update: 'status'
        },
        success: function(data){
          if (data == 1) {
            $('#taskTable').DataTable().ajax.reload()
            swal({
              title: 'Exitoso',
              text: 'Se ha actualizado la tarea',
              icon: 'success',
              timer: 2250
            })
          }else{
             swal({
              title: 'Oops',
              text: 'Intente de nuevo, si el problema perciste, notifique al administrador',
              icon: 'info',
              timer: 2500
            })
          }
        }
      })
 })


 $('body').on('click', '#taskTable .btn-add-pet', function(e){
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
          data: data+"&rescue_id="+idRescue+"&store_origin=tasks",
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
                    text: 'Intente de nuevo, si el problema perciste, notifique al administrador',
                    icon: 'info',
                    timer: 2500
                  })
              }
          }
      }) 
  })

  $('body').on('click', '#taskTable .btn-note', function(e){
    e.preventDefault()
    let idRescue = $(this).attr('data-rescue')
    $('#form-add-note').attr('data-rescue', idRescue)
    let url = '{{ route('Tareas.show', ':idtask') }}'.replace(':idtask', idRescue)
      $.ajax({
        url: url,
        type: 'get',
        success: function(data){
          $('#note').val(data['note'])
        }
      })
  }) 

$('#form-add-note').on('submit', function(e){
  e.preventDefault()
  let idtask = $(this).attr('data-rescue')
  let url = '{{ route('Tareas.update', ':idtask') }}'.replace(':idtask', idtask)
  let data = $(this).serialize()
    $.ajax({
      url: url,
      type: 'put',
      data: data+"&rescue_id="+idtask+"&type_update=note",
      success: function(data){
        if (data == 1) {
          $('#modal-note').modal('toggle')
          $('#note').val('')
          swal({
            title: 'Exitiso',
            text: 'Se ha establecido la nota',
            icon: 'success',
            timer: 2500
          })
        }else{
          swal({
            tetx: 'Error',
            text: 'Intente de nuevo, si el problema perciste, notifique al administrador',
            icon: 'info',
            timer: 2500
          })
        }
      }
    })
})

</script>
@endsection