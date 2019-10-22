@extends('dashboard.dashBase')

@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bandeja de solicitudes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Solicitudes</li>
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
        <table id="requestTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Revisado</th>
                <th scope="col">Estado</th>
                <th scope="col">Mascota</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
    @include('requestPet.seeRequest')
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
    $('#requestTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "{{ url('requestsPet') }}",
      "columns": [
      {data: 'fullName', width: '25%', mRender:function(data) {
        return '<p class="text-capitalize">'+data+'</p>'
      }},
      {data: 'seen', dataId: 'id' , mRender: function(data, type, row){
        if (data == 'revisado') {
          return `<span class="center text-capitalize"><a href="#" class="badge badge-info btn-seen" data-seen="0" data-request="`+row.id+`">`+row.seen+`</a></span>`
        }else{
          return `<span class="center text-capitalize"><a href="#" class="badge badge-warning btn-seen" data-seen="1" data-request="`+row.id+`">`+row.seen+`</a></span>`
        }
      }},
      {data: 'status', mRender: function(data, type, row){
         if (data == 'aprobado') {
          return `<span class="center text-capitalize"><a href="#" data-pet="`+row.pet_id+`" class="badge badge-success btn-status" data-status="0" data-request="`+row.id+`">`+data+`</a></span>`
        }else{
          return `<span class="center text-capitalize"><a href="#" data-pet="`+row.pet_id+`" class="badge badge-secondary btn-status" data-status="1" data-request="`+row.id+`">`+data+`</a></span>`
        }
      }},
      {data: 'infoPet', width: '15%', mRender: function(data){
          return `<p class="text-capitalize">`+data+`</p>`
      }},
      {data: 'created_at', width: '20%', mRender: function(data){
        return moment(data).format('LLL')
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
                            })
  }

  //CARGAMOS LA TABLA CUANDO LA PAGINA HAYA SIDO CARGADA
  $(document).ready(function() {
    showTable()
    moment.locale('es')
})





  $('body').on('click', '#requestTable .seeRequest', function(e){
    e.preventDefault()
    let form = $(this).parent('form')

      $.ajax({
        type: 'get',
        url: form.attr('action'),
        success: function(data){
          

          if (data['seen'] == 0) {
            data['seen'] = 'Sin revisar'
            $('#seen').removeClass('badge-info')
            $('#seen').addClass('badge-warning')
          }else{
            data['seen'] = 'Revisado'
            $('#seen').removeClass('badge-warning')
            $('#seen').addClass('badge-info')
          }

          if (data['status'] == 0) {
            data['status'] = 'No apovado'
            $('#status').removeClass('badge-success')
            $('#status').addClass('badge-secondary')
          }else{
            data['status'] = 'Aprovado'
            $('#status').removeClass('badge-secondary')
            $('#status').addClass('badge-success')
          }

          date = moment(data['created_at'])
          date = date.format('LLL')

          let telephone
          if (data['telephone']) {
            telephone = (data['telephone']).toString()
            telephone = telephone.slice(0, 4) + "-" +telephone.slice(4);
          }else{
            telephone = 'Sin registrar'
          }
          

          $('#header-message').text(data['name']+' '+data['lastName'])
          $('#pet-request').text('Mascota: '+data['pet']['name']+(data['pet']['breed'] == null ? ' ' : ' =>'+data['pet']['breed']) )
          $('#date-message').text('Fecha: '+ date)
          $('#email').text((data['email'] == null ? 'Sin registrar' : data['email']))
          $('#telephone').text(telephone)
          $('#message').text(data['message'])
          $('#seen').text(data['seen'])
          $('#status').text(data['status'])
        }
      })
  })



  $('body').on('click', '#requestTable .btn-borrar', function(e){
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
      let form = $(this).parents('form');
      let url = form.attr('action');
      $.post(url, form.serialize(), function(data){

            if (data == 1) {
              swal({
                  title: 'Exitoso!',
                  text: 'Se ha eliminado la solicitud',
                  icon: "success",
                  timer: 2500
                })
              $ ('#requestTable').DataTable().ajax.reload();
            }else{
              swal({
                title: 'Oops',
                text: 'No se pudo eliminar porque esta solicitud ya fue aporbada',
                icon: 'info',
                timer: 2500
              })
            }          
      })
  }
});
  })



 


  $('body').on('click', '#requestTable .btn-seen', function(e){
    e.preventDefault()
    let seen = $(this).attr('data-seen')
    let idRequest = $(this).attr('data-request')
    let url = '{{ route('Solicitudes.update', ':idRequest') }}'.replace(':idRequest', idRequest)
    let data = {
      seen: seen,
      type_update: 'seen',
      _token: '{{ csrf_token() }}'
    }
    $.ajax({
      url: url,
      type: 'put',
      data: data,
      success: function(data){
        if (data == 1) {
            $('#requestTable').DataTable().ajax.reload();
            swal({
              title: 'Exitiso',
              text: 'Este mensaje se ha marcado como leido',
              icon: 'success',
              timer: 2500
            })
          }else{
            swal({
              title: 'Oops',
              text: data,
              icon: 'info',
              timer: 2500
            })
          }
      }
    })
  })

    $('body').on('click', '#requestTable .btn-status', function(e){
    e.preventDefault()
    let status = $(this).attr('data-status')
    let idRequest = $(this).attr('data-request')
    let idPet = $(this).attr('data-pet')
    let url = '{{ route('Solicitudes.update', ':idRequest') }}'.replace(':idRequest', idRequest)
    let data = {
      status: status,
      type_update: 'status',
      _token: '{{ csrf_token() }}',
      pet_id: idPet
    }
    $.ajax({
      url: url,
      type: 'put',
      data: data,
      success: function(data){
        $('#requestTable').DataTable().ajax.reload();
        if (data == 1) {
            swal({
              title: 'Exitiso',
              text: 'Se ha aprobado esta solicitud',
              icon: 'success',
              timer: 2500
            })
          }else{
            swal({
              title: 'Oops',
              text: data,
              icon: 'info',
              timer: 2500
            })
          }
      }
    })
  })
</script>
@endsection