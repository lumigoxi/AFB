@extends('dashboard.dashBase')

@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bandeja de mensajes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Mensajes</li>
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
        <table id="messageTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Razón</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
    @include('message.seeMessage')
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
    $('#messageTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "{{ url('Messages/getAllMessages') }}",
      "columns": [
      {data: 'DT_RowIndex', width: '5%'},
      {data: 'fullName', width: '25%', mRender:function(data) {
        return '<p class="text-capitalize">'+data+'</p>'
      }},
      {data: 'reason', width: '15%', mRender: function(data){
        if (data == 'Ser Colaborador') {
          return `<div class="text-center">
                    <span class="badge badge-success">`+data+`</span>
                </div>`
        }else if(data == 'Rescate'){
          return `<div class="text-center">
                    <span class="badge badge-danger">`+data+`</span>
                </div>`
        }else{
          return `<div class="text-center">
                    <span class="badge badge-warning">`+data+`</span>
                </div>`
        }
      }},
      {data: 'btn-status', width: '5%'},
      {data: 'created_at', width: '20%', mRender: function(data){
        return moment(data).format('LLL')
      }},
      {data: 'btn', width: '10%'}
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





  $('body').on('click', '#messageTable .seeMessage', function(e){
    e.preventDefault()
    let form = $(this).parent('form')

      $.ajax({
        type: 'get',
        url: form.attr('action'),
        success: function(data){
          if (data['reason']==2) {
            data['reason']='Ser Colaborado'
          }else if(data['reason'] == 3){
            data['reason'] = 'Rescate'
          }else{
            data['reason'] = 'Otro'
          }

          if (data['status'] == 0) {
            data['status'] = 'Pendiente'
            $('#status').removeClass('badge-info')
            $('#status').addClass('badge-danger')
          }else{
            data['status'] = 'Atendido'
            $('#status').removeClass('badge-danger')
            $('#status').addClass('badge-info')
          }

          date = moment(data['created_at'])
          date = date.format('LLL')

          let telephone = (data['telephone']).toString()
          telephone = telephone.slice(0, 4) + "-" +telephone.slice(4);

          $('#header-message').text(data['name']+' '+data['lastName'])
          $('#reason-message').text('Asunto: '+data['reason'])
          $('#date-message').text('Fecha: '+ date)
          $('#email').text(data['email'])
          $('#telephone').text(telephone)
          $('#message').text(data['message'])
          $('#status').text(data['status'])
        }
      })
  })



  $('body').on('click', '#messageTable .btn-borrar', function(e){
      e.preventDefault()
       swal({
  title: "¿Seguro de eliminar el mensaje?",
  text: "Una vez eliminado no se podra revertir el cambio",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("El mensaje se ha eliminado", {
      icon: "success",
    });
      let form = $(this).parents('form');
      let url = form.attr('action');
      $.post(url, form.serialize(), function(){
          $ ('#messageTable').DataTable().ajax.reload();
      })
  }
});
  })



 


  $('body').on('click', '#messageTable .btn-status', function(e){
    e.preventDefault()
    let status = $(this).attr('data-status')
    let form = $(this).parent().parent()
    let url = form.attr('action')
    let data = form.serialize()
    $.ajax({
      url: url,
      type: 'put',
      data: data+"&status="+status,
      success: function(data){
        if (data == 1) {
            $('#messageTable').DataTable().ajax.reload();
            swal({
              title: 'Exitiso',
              text: 'Este mansaje se ha revisado',
              icon: 'success',
              timer: 2500
            })
          }else{
            swal({
              title: 'Oops',
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