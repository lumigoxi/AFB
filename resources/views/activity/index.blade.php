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
          <div class="container">
		<div class="row">
			<div class="col">
				<hr>
				<a href="{{ route('dashboard') }}" class="btn btn-secondary ">Regresar</a>
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#create-activity">Agregar nueva actividad</a>
				<hr>
        <table id="activityTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Creado por</th>
                <th scope="col">Actividad</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
        @include('activity.create')
        @include('activity.edit')
        @include('activity.more')
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
    $('#activityTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "{{ url('actividades/getAllActivitys') }}",
      "columns": [
      {data: "id"},
      {data: 'name'},
      {data: 'activity'},
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
        let title = document.getElementById('seeTitle');
        let description = document.getElementById('seeDescription');
        title.innerHTML=data['activity'];
        description.innerHTML = data['decription'];
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
    data: $(this).serialize(),
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

</script>
@endsection