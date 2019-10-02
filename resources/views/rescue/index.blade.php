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
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#create-story">Registrar rescate</a>
				<hr>
        <table id="rescueTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Razon</th>
                <th scope="col">Prioridad</th>
                <th scope="col">Estado</th>
                <th scope="col">Registrado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
    @include('rescue.more')
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
      "ajax": "{{ url('rescue/getAllRescues') }}",
      "columns": [
      {data: 'DT_RowIndex', width: '5%'},
      {data: 'reason', width: '50%'},
      {data: 'priority', width: '5%', render: function(data, type, row){
        if (data == 'Alta') {
          return `<div class="dropdown">
              <button class="btn btn-success btn-sm btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  `+data+`
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item btn-priority" href="#" data-priority="0">Alta</a>
                <a class="dropdown-item btn-priority" href="#" data-prority="1">Media</a>
                <a class="dropdown-item btn-priority" href="#" data-priority="2">Baja</a>
              </div>
          </div>`
        }else if(data == 'Media'){
          return `<div class="text-center"> 
          <a href="#" class="badge badge-warning">`+data+`</a>
          </div>`
        }else{
          return `<div class="text-center"> 
          <a href="#" class="badge badge-secondary">`+data+`</a>
          </div>`
        }
      }},
      {data: 'status', width: '5%', mRender: function(data, type, row){
        if (data == 'Listo') {
          return `<div class="text-center"> 
          <a href="#" class="badge badge-success">`+data+`</a>
          </div>`
        }else if(data == 'Pendiente'){
          return `<div class="text-center"> 
          <a href="#" class="badge badge-danger">`+data+`</a>
          </div>`
        }else{
          return `<div class="text-center"> 
          <a href="#" class="badge badge-info">`+data+`</a>
          </div>`
        }
      }},
      {data: 'created_at', width: '15%'},
      {data: 'btn', width: '20%', orderable: false}
      ],
      createdRow: function( row, data, dataIndex ) {
        // Set the data-status attribute, and add a class
        $( row ).find('td:eq(2)')
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
    $.ajax({
      url: form.attr('action'),
      type: 'get',
      success: function(data){
        let title = document.getElementById('see-reason-rescue');
        let description = document.getElementById('see-description-rescue');
        title.innerHTML=data['reason'];
        description.innerHTML = data['description'];
      }
    })
  })

  $('body').on('click', '#rescueTable .btn-priority', function(e){
    e.preventDefault()
    let idRescue = $(this).parent().parent().parent().attr('data-rescue')
    console.log(idRescue)
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
            console.log(data)
          }
      })
  })
</script>
@endsection