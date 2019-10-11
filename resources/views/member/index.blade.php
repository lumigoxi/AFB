@extends('dashboard.dashBase')

@section('content')
	 <!-- Content Header (Page header) -->
    <div class="content-header py-0 pt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista de miembros</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 py-auto">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Miembros</li>
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
				<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-user">Crear nuevo Miembro</a>
				<hr>
        <table id="memberTable" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha de creación</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
        @include('member.create')
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
    $('#memberTable').DataTable({
      "serverSide": true,
     "ajax": {
            "url": "{{ url('miembros/getAllUser') }}",
            "data": { 
            "request_url": "tps"
        }
        },
      "columns": [
      {data: 'id'},
      {data: 'name'},
      {data: 'email'},
      {data: 'status', mRender: function(data){
        if (data == 'Activo') {
                return `<div class="text-center">
                    <a href="#" class="badge badge-success btn-status"  data-status="1">`+data+`</a>
                </div>`;
            }else{
                return `<div class="text-center">
                    <a href="#" class="badge badge-danger btn-status" data-status="0">`+data+`</a>
                </div>`;
            }
      }},
      {data: 'created_at'},
      {data: 'btn'},
      ],
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
} );



    //ELIMINAR MIEMBRO | NO HACE FALTA CARGAR LA TABLA  
    $('body').on("click", "#memberTable .borrarMiembro",function(e){
      e.preventDefault();
      swal({
  title: "¿Seguro de eliminar al miembro?",
  text: "Una vez eliminado no se podra revertir el cambio",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("El miembro se ha eliminado exitosamente", {
      icon: "success",
    });
       let row = $(this).parents('tr');
      let form = $(this).parents('form');
      let url = form.attr('action');
      $.post(url, form.serialize(), function(){
        row.fadeOut();
      })
  }
});
    });


     $('body').on('click' ,'#memberTable .btn-status', function(e){
        e.preventDefault();
        let tag_currently = $(this)
        const idMember = $(this).parent().parent().siblings('td').children('form').children('a').attr('data-member');
        let url = '{{ route('miembros.update', ':idMember') }}'
        url = url.replace(':idMember', idMember)
        let status = $(this).attr('data-status')
        let data = {
          status: status,
          request_url: 'tps',
          _token: '{{ csrf_token() }}'  
        }
        $.ajax({
        type: 'put',
        url: url,
        data: data,
        success: function(data){
           if (data) {
                        if (status == 0) {
                            tag_currently.attr('data-status', 1)
                            tag_currently.removeClass('badge-danger')
                            tag_currently.addClass('badge-success')
                            tag_currently.text('Activo')
                            swal("Actualizado!", "EL usuario ha sido activado", "success")
                        }else if(status == 1){
                            tag_currently.attr('data-status', 0)
                            tag_currently.removeClass('badge-success')
                            tag_currently.addClass('badge-danger')
                            tag_currently.text('Inactivo')
                            swal("Actualizado!", "EL usuario no ha sido inactivado", "success")

                        }
                    }else{
                        swal("Error", "Algo ha salido mal", "error")
                    }

        }
        })
     })
</script>
@endsection