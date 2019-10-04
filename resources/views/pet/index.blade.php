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
				<a href="{{ route('dashboard') }}" class="btn btn-secondary ">Regresar</a>
				<hr>
        <table id="petTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Mascota</th>
                <th scope="col">Raza</th>
                <th scope="col">Albergue</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
    @include('rescue.more')
    @include('pet.edit')
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
      "processing": true,
      "serverSide": true,
      "ajax": "{{ url('dashboard/Mascotas/getAllPet') }}",
      "columns": [
      {data: 'DT_RowIndex', width: '5%'},
      {data: 'name'},
      {data: 'breed'},
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





  $('body').on('click', '#petTable .btn-editar', function(e){
    e.preventDefault()
    let form = $('#form-edit-pet')
    let url = $(this).parent('form').attr('action')
      $.ajax({
          url: url,
          type: 'get',
          success: function(data){
              if (data['rescue_id'] == 0) {
                form.children('div').children('div').children('#input-search-rescue').attr('placeholder', 'Ingrese rescate')
                 $('#input-search-rescue').val('')
                      $('#name').val('') 
                      $('#breed').val('')
                      $('#city').val('')
                      $('#located_at').val('')
                      $('#form-edit-pet').attr('data-pet', data['id'])

              }else{
                 $('form #input-search-rescue').val(data['rescue']['reason'])
                      $('#result-rescue').val(data['rescue']['located_at']) 
                      $('#name').val(data['name'])
                      $('#breed').val(data['breed'])
                      $('#city').val(data['city'])
                      $('#located_at').val(data['located_at'])
                      $('#form-edit-pet').attr('data-pet', data['id'])
              }
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
        data: form.serialize(),
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

</script>
@endsection